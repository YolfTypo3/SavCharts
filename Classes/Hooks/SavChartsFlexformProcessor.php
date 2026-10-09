<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with TYPO3 source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace YolfTypo3\SavCharts\Hooks;

use TYPO3\CMS\Core\DataHandling\DataHandler;
   
/**
 * Hook for processing the Flexform
 */
final class SavChartsFlexformProcessor
{
  
    protected string $parserType;
    
    protected array $debugContent = [];
    
    /**
     * Pre-processes the field array.
     * 
     * @param array $fieldArray
     * @param string $table
     * @param string $id
     * @param DataHandler $dataHandler
     * 
     * @return void
     */
    public function processDatamap_preProcessFieldArray(array &$fieldArray, string $table, string $id, DataHandler $dataHandler): void
    {
        if ($table === 'tt_content') {
            $flexform = $fieldArray['pi_flexform'] ?? null;
            if (empty($flexform)) {
                return;
            }
            // Gets the sDEF settings.
            $sDEF = $flexform['data']['sDEF']['lDEF'];
            if (empty($sDEF['settings.flexform.allowConverter']['vDEF'] ?? null)) {
                return;
            }
            
            // Gets the parser type.
            $this->parserType = $flexform['data']['sDEF']['lDEF']['settings.flexform.parserType']['vDEF'];
            
            // Gets the converter sheet.
            $converterSheet = $flexform['data']['converter']['lDEF'] ?? null;
            if ($converterSheet === null) {
                return;
            }
            
            // Gets the JavaScript field.
            $javaScript = $converterSheet['settings.flexform.converterJavaScript']['vDEF'];

            // Converts Javascript to Json.
            $json = $this->javaScriptToJson($javaScript);

            // Converts Json to PHP array
            $phpArray = json_decode($json);
            
            if (empty($phpArray)) {
                $result[] = 'Conversion failed:' . json_last_error_msg();
                $result = array_merge($result, $this->debugContent);
            } else {
                $result[] = $this->jsonToFluidParser($phpArray);
            }
                    
            $fieldArray['pi_flexform']['data']['converter']['lDEF']['settings.flexform.converterParser']['vDEF'] = implode(chr(10), $result);
        }
    }
        
    /**
     * Converts JavaScript to Json.
     *
     * @param string $content
     *
     * @return string
     */
    protected function javaScriptToJson(string $content): string
    {
        $conversionFunctions = [
            'removeSimpleComments',
            'removeTrailingCharacters',
            'addQuotesToKeys',
            'replaceTrueFalseNull',
            'replaceBracesInStrings',
            'convertArrayOfNumbers',
            'convertArrayOfStrings',
            'convertFunctions',
            'convertVariablesToReferences',
            'replaceSimpleQuotes',
            'replaceOtherFunctions'
        ];
        
        $this->debugContent = [];
        foreach($conversionFunctions as $conversionFunction) {
            $content = $this->$conversionFunction($content);
            $this->debugContent[] = '';
            $this->debugContent[] = '==========';
            $this->debugContent[] = ucfirst($conversionFunction);
            $this->debugContent[] = '==========';
            $this->debugContent[] = '';
            $this->debugContent[] = $content;
        }
        
        return $content;
    }
    
    /**
     * Converts Json to Fluid Parser.
     *
     * @param mixed $values
     * @param int $count
     *
     * @return string
     */
    protected function jsonToFluidParser(mixed $values, int $count = 0): string
    {
        $result = [];
        $space = str_repeat(' ', $count);

        foreach($values as $key => $value) {
            switch (gettype($value)) {
                case 'array':
                case 'object':
                    $result[] = $space . '<c:item key="' . $key . '">';
                    $result[] = $this->jsonToFluidParser($value, $count + 4);
                    $result[] = $space . '</c:item>';                    
                    break;
                case 'string':
                    $value = str_replace(
                        [
                            '__BRACE_OPEN__', 
                            '__BRACE_CLOSE__', 
                            '__QUOTE__',
                            '__TRUE__',
                            '__FALSE__',
                            '__NULL__',
                            '__CR__',
                            '__LF__'
                        ], 
                        [
                            '{', 
                            '}', 
                            '\'',
                            'true',
                            'false',
                            'null',
                            chr(13),
                            chr(10,)
                        ], 
                        $value
                    );
                    if (preg_match('/__\[__(.+?)__\]__/s', $value, $matches)) {
                        $result[] = $space . '<c:item key="' . $key . '" values="' . $matches[1] . '" />';
                    } elseif (preg_match('/__FCT__(.+?)__FCT__/s', $value, $matches)) {
                        $result[] = $space . '<c:item key="' . $key . '" callback="true">';
                        $result[] = $space . '    ' . $matches[1];
                        $result[] = $space . '</c:item>';
                    } elseif (preg_match('/__REF__(.+?)__REF__/s', $value, $matches)) {
                        $result[] = $space . '<c:item key="' . $key . '" value="{data__' . $matches[1] . '}" />';
                    } else {
                        $result[] = $space . '<c:item key="' . $key . '" value="' . $value . '" />';                    
                    }
                    break;
                case 'integer':  
                    $result[] = $space . '<c:item key="' . $key . '" value="' . $value . '" />';
                    break;
            }
        }
        
        return implode(chr(10), $result);
    }

    /**
     * Conversion functions
     * 
     */  
    
    /**
     * Remove simple comments.
     *
     * @param string $content
     * 
     * @return string
     */
    protected function removeSimpleComments(string $content): string
    {
        $content = preg_replace(
            '/\/\/.*?[\n\r]/s',
            '',
            $content
            );
        
        return $content; 
    }

    /**
     * Remove trailing characters.
     *
     * @param string $content
     *
     * @return string
     */
    protected function removeTrailingCharacters(string $content): string
    {
        /***
         * 0 - Replaces ,} by }
         * 1 - Replaces ,] by ]
         * 2 - Replaces },} by }}
         * 3 - Replaces },] by }]
         */
        $content = preg_replace(
            [
                '/,\s*}/',
                '/,\s*]/',
                '/}\s*,(\s*})/',
                '/}\s*,(\s*])/',
            ],
            [
                '}',
                ']',
                '}$1',
                '}$1',
            ],
            $content
            );
        
        return $content; 
    }
    
    /**
     * Add quotesto keys.
     *
     * @param string $content
     *
     * @return string
     */
    protected function addQuotesToKeys(string $content): string
    {
        $content = preg_replace(
            '/([a-zA-Z0-9\_]+)\s*:/',
            '"$1":',
            $content
            );
  
        return $content; 
    }
    
    /**
     * Replace true, false or null.
     *
     * @param string $content
     *
     * @return string
     */
    protected function replaceTrueFalseNull(string $content): string
    {
        $content = preg_replace(
            [
                '/:\s*true/',
                '/:\s*false/',
                '/:\s*null/',
            ],
            [
                ': "__TRUE__"',
                ': "__FALSE__"',
                ': "__NULL__"',
            ],
            $content
            );
        
        return $content;
    }
    
    /**
     * Replace braces in strings.
     *
     * @param string $content
     *
     * @return string
     */
    protected function replaceBracesInStrings(string $content): string
    {
        $content = preg_replace_callback(
            '/\'(.*?)\'/s',
            function($matches) { 
                return '\'' . str_replace(['{', '}'], ['__BRACE_OPEN__', '__BRACE_CLOSE__'], $matches[1]) . '\'';
            },
            $content
            );
        
        return $content;
    }

    /**
     * Convert array of numbers.
     *
     * @param string $content
     *
     * @return string
     */
    protected function convertArrayOfNumbers(string $content): string
    {
        $content = preg_replace(
            '/\[\s*((?:[0-9.]+\s*,?\s*)+)\]/',
            '"__[__$1__]__"',
            $content
            );
        
        return $content;
    }

    /**
     * Remove array of strings.
     *
     * @param string $content
     *
     * @return string
     */
    protected function convertArrayOfStrings(string $content): string
    {
        $content = preg_replace_callback(
            '/\[\s*((?:\'[^\']+?\'\s*,?\s*)+)\]/s',
            function($matches) {
                return '"__[__' . str_replace('\'', '', $matches[1]) . '__]__"';
            },
            $content
            );
        
        return $content;
    }

    /**
     * Convert functions.
     *
     * @param string $content
     *
     * @return string
     */
    protected function convertFunctions(string $content): string
    {
        $content = preg_replace_callback(
            '/:(\s*function)(.*)/s',
            function($matches) {
                $result = $this->extractEncompassingBraces($matches[2]);
                if (!empty($result[0])) {
                    $result[0] = str_replace(['\'', chr(13), chr(10)], ['__QUOTE__', '__CR__', '__LF__'], $result[0]);
                    return ': "__FCT__' . $matches[1] . $result[0] . '__FCT__"' . $this->convertFunctions($result[1]);
                } else {
                    return $result[1];
                }
            },
            $content
            );
        
        return $content;
    }

    /**
     * Convert variables to references.
     *
     * @param string $content
     *
     * @return string
     */
    protected function convertVariablesToReferences(string $content): string
    {
        $content = preg_replace(
            '/(".*?"\s*:\s)([a-zA-Z\_\$][a-zA-Z0-9\_\$]+)(,|}\s*,|}\s*])/',
            '$1"__REF__$2__REF__"$3',
            $content
            );
        
        return $content;
    }
    
    /**
     * Replace simple quotes.
     *
     * @param string $content
     *
     * @return string
     */
    protected function replaceSimpleQuotes(string $content): string
    {
        $content = preg_replace(
            '/\'/',
            '"',
            $content
            );
        
        return $content;
    }
    
    /**
     * Remove other functions.
     *
     * @param string $content
     *
     * @return string
     */
    protected function replaceOtherFunctions(string $content): string
    {
        $content = preg_replace(
            [
                '/(".*?"\s*:\s*[{\[]*?)([^"]*?\(.*?\))(,|}\s*,|}\s*])/s',
                '/(".*?"\s*:\s*)([a-zA-Z].*?\(.*?\))\s*(,|}\s*,|}\s*])/',
                '/(".*?"\s*:\s*)([^"]*?)\s*(,|}\s*,|}\s*])/',
            ],
            [
                '$1"__FCT__$2__FCT__"$3',
                '$1"__FCT__$2__FCT__"$3',
                '$1"__FCT__$2__FCT__"$3',
            ],
            $content
            );

        return $content;
    }
    
    /**
     * Extract encompassing braces.
     *
     * @param string $content
     *
     * @return string
     */
    protected function extractEncompassingBraces(string $content): array
    {
        $stack = [];
        $start = -1;
        $end = -1;
        $maxDepth = 0;
        $currentDepth = 0;
        
        for ($i = 0; $i < strlen($content); $i++) {
            if ($content[$i] === '{') {
                $currentDepth++;
                $stack[] = $i; // Pushes the index of the opening brace
                if ($currentDepth > $maxDepth) {
                    $maxDepth = $currentDepth;
                    $start = $i; // Updates start index
                }
            } elseif ($content[$i] === '}') {
                if (!empty($stack)) {
                    array_pop($stack); // Pops the last opening brace index
                    $currentDepth--;
                    if (empty($stack)) {
                        $end = $i; // Updates end index
                        break;
                    }
                }
            }
        }
        
        // Returns the encompassing braces and the end of the string
        if ($start !== -1 && $end !== -1) {
            return [
                substr($content, 0, $end + 1),
                substr($content, $end + 1)
            ];
        } 
        
        return ['', $content]; // Returns the content if no braces are found
    }
}
