<?php
namespace YolfTypo3\SavCharts\XmlParser;

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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use YolfTypo3\SavCharts\Compatibility\EnvironmentCompatibility;
use YolfTypo3\SavCharts\Controller\DefaultController;

/**
 * Class xmlGraph
 */
class XmlParser
{

    /**
     * Allowed chart tags
     *
     * @var array
     */
    protected static $allowedChartTags = [
        'pieChart' => [
            'type' => 'pie',
            'options' => []
        ],
        'barChart' => [
            'type' => 'bar',
            'options' => [
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => 1
                            ]
                        ]
                    ]
                ]
            ]
        ],
        'bubbleChart' => [
            'type' => 'bubble',
            'options' => []
        ],
        'doughnutChart' => [
            'type' => 'doughnut',
            'options' => []
        ],
        'horizontalBarChart' => [
            'type' => 'horizontalBar',
            'options' => [
                'scales' => [
                    'xAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => 1
                            ]
                        ]
                    ]
                ]
            ]
        ],
        'horizontalStackedBarChart' => [
            'type' => 'horizontalBar',
            'options' => [
                'scales' => [
                    'xAxes' => [
                        [
                            'stacked' => true
                        ]
                    ],
                    'yAxes' => [
                        [
                            'stacked' => true,
                            'ticks' => [
                                'beginAtZero' => 1
                            ]
                        ]
                    ]
                ]
            ]
        ],
        'radarChart' => [
            'type' => 'radar',
            'options' => []
        ],
        'polarAreaChart' => [
            'type' => 'polarArea',
            'options' => [
                'scale' => [
                    'ticks' => [
                        'beginAtZero' => 1
                    ]
                ]
            ]
        ],
        'lineChart' => [
            'type' => 'line',
            'options' => [
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => 1
                            ]
                        ]
                    ]
                ]
            ]
        ],
        'stackedBarChart' => [
            'type' => 'bar',
            'options' => [
                'scales' => [
                    'xAxes' => [
                        [
                            'stacked' => true
                        ]
                    ],
                    'yAxes' => [
                        [
                            'stacked' => true,
                            'ticks' => [
                                'beginAtZero' => 1
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ];

    /**
     * The xml reference
     *
     * @var \SimpleXMLElement
     */
    protected $xml = null;

    /**
     * The controller
     *
     * @var \YolfTypo3\SavCharts\Controller\DefaultController
     */
    protected static $controller = null;

    /**
     * True is the xml was correctly loaded
     *
     * @var boolean
     */
    protected $isLoaded;

    /**
     * The xml tag results
     *
     * @var array
     */
    protected static $xmlTagResults = [];

    /**
     * Injects the controller
     *
     * @param \YolfTypo3\SavCharts\Controller\DefaultController $controller
     *
     * @return void
     */
    public function injectController(DefaultController $controller)
    {
        self::$controller = $controller;
    }

    /**
     * Gets the controller
     *
     * @return \YolfTypo3\SavCharts\Controller\DefaultController $controller
     */
    public static function getController(): DefaultController
    {
        return self::$controller;
    }

    /**
     * Gets a xml tag result
     *
     * @param string $name
     *            tag name
     * @param mixed $id
     *            id
     * @return array
     */
    public static function getXmlTagResult(string $name, $id)
    {
        if (isset(self::$xmlTagResults[$name]) && isset(self::$xmlTagResults[$name][$id])) {
            return self::$xmlTagResults[$name][$id];
        }
        return null;
    }

    /**
     * Sets a xml tag result
     *
     * @param string $name
     *            tag name
     * @param string $id
     *            id
     * @param mixed $value
     *
     * @return void
     */
    public static function setXmlTagResult(string $name, $id, $value)
    {
        if ($id === null) {
            self::$xmlTagResults[$name][] = $value;
        } else {
            self::$xmlTagResults[$name][$id] = $value;
        }
    }

    /**
     * Clears a xml tag result
     *
     * @param string $name
     *            tag name
     * @param string $id
     *            id
     *
     * @return void
     */
    public static function clearXmlTagResult(string $name, $id)
    {
        if (isset(self::$xmlTagResults[$name][$id])) {
            unset(self::$xmlTagResults[$name][$id]);
        }
    }

    /**
     * Clears the xml tag results array
     *
     *
     * @return void
     */
    public function clearXmlTagResults()
    {
        self::$xmlTagResults = [];
    }

    /**
     * Gets a reference object
     *
     * @param mixed $reference
     *
     * @return void
     */
    public static function getReferenceObject($reference)
    {
        // Gets the tag and the id
        $matches = self::isReference($reference);
        if ($matches !== false) {
            $xmlTag = $matches[1];
            $id = $matches[2];
            $xmlTagResult = XmlParser::getXmlTagResult($xmlTag, $id);
            if ($xmlTagResult === null) {
                // The reference is not known yet. Creates a new object.
                $xmlTagObject = self::getXmlTagObject($xmlTag);
                $xmlTagObject->setXmlTagId($id);
                self::setXmlTagResult($xmlTag, $id, $xmlTagObject);
                return $xmlTagObject;
            }
            return $xmlTagResult->getXmlTagValue();
        } else {
            return self::getController()->addError('error.referenceNotWellFormed', [
                $reference
            ]);
        }
    }

    /**
     * Retuns a xml tag object
     *
     * @param string $xmlTag
     *
     * @return \YolfTypo3\SavCharts\XmlParser\GeneralXmlTag\AbstractXmlTag
     */
    public static function getXmlTagObject(string $xmlTag)
    {
        $className = self::getClassName($xmlTag);
        if ($className === false) {
            return self::getController()->addError('error.unknownClass', [
                $xmlTag
            ]);
        }

        // Creates the xml tag object
        return GeneralUtility::makeInstance($className);
    }

    /**
     * Gets the xml attribute id
     *
     * @param \SimpleXMLElement $element
     *
     * @return string
     */
    public static function getIdAttribute(\SimpleXMLElement $element)
    {
        $id = (string) $element->attributes()->id;
        if ($id == '') {
            $id = 0;
        }
        if (self::isReference($id)) {
            $id = self::getValueFromReference($id);
        }
        return $id;
    }

    /**
     * Gets the xml attribute overload
     *
     * @param \SimpleXMLElement $element
     *
     * @return string
     */
    public static function getOverloadAttribute(\SimpleXMLElement $element)
    {
        $overload = (string) $element->attributes()->overload;
        return ! empty($overload);
    }

    /**
     * Gets the xml class name
     *
     * @param string $xmlTag
     *
     * @return string or false
     */
    protected static function getClassName(string $xmlTag)
    {
        $className = 'YolfTypo3\\SavCharts\\XmlParser\\GeneralXmlTag\\' . ucfirst($xmlTag) . 'XmlTag';
        if (! class_exists($className)) {
            $className = 'YolfTypo3\\SavCharts\\XmlParser\\ChartXmlTag\\' . ucfirst($xmlTag) . 'XmlTag';
        }
        if (class_exists($className)) {
            // Creates the xml tag object
            return $className;
        } else {
            return false;
        }
    }

    /**
     * Loads a xml file
     *
     * @param string $fileName
     *            File name
     *
     * @return void
     */
    public function loadXmlFile(string $fileName)
    {
        $this->isLoaded = false;

        // Uses XML internal errors
        libxml_use_internal_errors(true);

        // Loads the xml file
        $this->xml = @simplexml_load_file($fileName);

        // Checks if an error is detected
        if ($this->xml === false) {
            $errors = libxml_get_errors();
            // Displays the first error
            self::getController()->addError('error.xmlSyntaxError', [
                $errors[0]->message,
                $errors[0]->line,
                $fileName
            ]);
            return;
        }
        $this->isLoaded = true;
    }

    /**
     * Load a xml string
     *
     * @param string $xmlString
     *            xml string
     *
     * @return void
     */
    public function loadXmlString(string $xmlString)
    {
        $this->isLoaded = false;

        // Uses XML internal errors
        libxml_use_internal_errors(true);

        // Adds the prologue
        $xmlString = $this->addXmlPrologue($xmlString);

        // Loads the xml string
        $this->xml = @simplexml_load_string($xmlString);

        // Checks if an error is detected
        if ($this->xml === false) {
            $errors = libxml_get_errors();
            // Displays the first error
            self::getController()->addError('error.xmlSyntaxError', [
                $errors[0]->message,
                $errors[0]->line,
                $xmlString
            ]);
            return;
        }
        $this->isLoaded = true;
    }

    /**
     * Parses the xml
     *
     * @return void
     */
    public function parseXml()
    {
        // Checks if xml is correclty loaded
        if (! $this->isLoaded) {
            return;
        }

        // Processes the element
        $this->processXmlElement($this->xml);
    }

    /**
     * Processes a xml element
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function processXmlElement(\SimpleXMLElement $element)
    {
        $xmlTag = (string) $element->getName();
        $xmlTagObject = self::getXmlTagObject($xmlTag);
        if ($xmlTagObject === null) {
            return;
        }
        $id = self::getIdAttribute($element);
        $xmlTagObject->setXmlTagId($id);
        $xmlTagObject->setOverload(self::getOverloadAttribute($element));

        if (! count($element->children())) {
            // Calls the default method
            $xmlTagObject->defaultMethod($element);
        } else {
            // Processes the children
            foreach ($element->children() as $child) {
                $childName = (string) $child->getName();
                $className = self::getClassName($childName);
                if ($childName == 'for') {
                    // Calls the default method
                    $xmlForTagObject = self::getXmlTagObject($childName);
                    if ($xmlForTagObject === null) {
                        return;
                    }
                    $idFor = self::getIdAttribute($child);
                    $xmlForTagObject->setXmlTagId($idFor);
                    $xmlForTagObject->defaultMethod($child);
                } elseif ($className !== false) {
                    // Processes the class
                    $this->processXmlElement($child);
                } elseif (method_exists($xmlTagObject, $childName)) {
                    // Calls the method if it exists
                    $xmlTagObject->$childName($child);
                } else {
                    return self::getController()->addError('error.unknownXmlTag', [
                        $childName
                    ]);
                }
            }
        }

        // Calls the post processing method if it exists
        if (method_exists($xmlTagObject, 'postProcessingMethod')) {
            $xmlTagObject->postProcessingMethod($element);
        }

        // Sets the xmlTagValues array :
        // - if the tag result is not null but the value is null (this case occurs when a reference is not know yet.
        // An object is created and can now be filled)
        // - if the tag result does not already exist (tag values cannot be overloaded by default)
        // - if the tag result is not null but the overload attribute is set
        if (self::getXmlTagResult($xmlTag, $id) !== null && self::getXmlTagResult($xmlTag, $id)->getXmlTagValue() === null) {
            self::getXmlTagResult($xmlTag, $id)->setXmlTagValue($xmlTagObject->getXmlTagValue());
        } elseif (self::getXmlTagResult($xmlTag, $id) === null) {
            self::setXmlTagResult($xmlTag, $id, $xmlTagObject);
        } elseif (self::getXmlTagResult($xmlTag, $id) !== null && self::getXmlTagResult($xmlTag, $id)->getOverload()) {
            $xmlTagValue = self::getXmlTagResult($xmlTag, $id)->getXmlTagValue();
            if (is_array($xmlTagValue)) {
                $xmlTagValue = array_merge($xmlTagValue, $xmlTagObject->getXmlTagValue());
            } else {
                $xmlTagValue = $xmlTagObject->getXmlTagValue();
            }
            self::getXmlTagResult($xmlTag, $id)->setXmlTagValue($xmlTagValue);
        }
    }

    /**
     * Processes subitems of an item element
     *
     * @param \SimpleXMLElement $element
     *
     * @return void
     */
    public function processSubItemElement(\SimpleXMLElement $element)
    {
        // Processes the children
        $subItem = [];
        foreach ($element->children() as $child) {
            $childName = (string) $child->getName();
            if ($childName === 'item') {

                // Gets the key
                $key = (string) $child->attributes()->key;
                if ($key == '') {
                    return self::getController()->addError('error.missingAttribute', [
                        'key',
                        'item'
                    ]);
                }
                if (self::isReference($key) !== false) {
                    $key = self::getValueFromReference($key);
                }

                // Gets the value
                $attributes = $child->attributes();
                if (isset($attributes['value'])) {
                    $value = (string) $child->attributes()->value;
                    if (self::isReference($value) !== false) {
                        $value = self::getValueFromReference($value);
                    }
                    $type = (string) $child->attributes()->type;
                    if ($type === 'function') {
                        $value = '<!--' . $value . '-->';
                    } elseif ($value === 'true') {
                        $value = true;
                    } elseif ($value === 'false') {
                        $value = false;
                    } elseif (is_numeric($value)) {
                        $value = $value + 0;
                    }
                } elseif (isset($attributes['values'])) {
                    $commaSeparatedValue = XmlParser::replaceSpecialChars($attributes['values']);
                    $processedValues = GeneralUtility::trimExplode(',', $commaSeparatedValue);
                    $value = [];
                    foreach ($processedValues as $processedValueKey => $processedValue) {
                        if (is_numeric($processedValue)) {
                            $processedValue = $processedValue + 0;
                        }
                        $value[$processedValueKey] = $processedValue;
                    }
                } else {
                    if (count($child->children()) > 0) {
                        $value = $this->processSubItemElement($child);
                    } else {
                        $value = (string) $child;
                    }
                }
                $subItem[$key] = $value;
            } else {
                $xmlTagObject = self::getXmlTagObject('data');
                if (method_exists($xmlTagObject, $childName)) {
                    // Calls the method if it exists
                    $xmlTagObject->$childName($child);
                    $value = $xmlTagObject->getXmlTagValue();
                    // return $value;
                    if ($childName === 'callback') {
                        $subItem[key($value)] = current($value);
                    } else {
                        return $value;
                    }
                }
            }
        }

        return $subItem;
    }

    /**
     * Processes a constant
     *
     * @param string $value
     *
     * @return mixed
     */
    protected function processConstant(string $value)
    {
        return (defined($value) ? constant($value) : $value);
    }

    /**
     * Post processing
     *
     * @return array
     */
    public function postProcessing(): array
    {
        // Creates the directory for the csv file
        if (! is_dir('typo3temp/sav_charts')) {
            mkdir('typo3temp/sav_charts');
        }

        // Gets the content uid
        if (self::$controller === null) {
            $contentObjectUid = '###contentObjectUid###';
        } else {
            $contentObjectUid = self::$controller->getContentObjectRenderer()->data['uid'];
        }

        // Resolves reference known by object (it occurs when a reference was
        // not defined when used. An object was created which now contains the
        // reference value)
        foreach (self::$xmlTagResults as $xmlTagKey => $xmlTag) {
            foreach ($xmlTag as $xmlTagResultKey => $xmlTagResult) {
                $xmlTagValue = $xmlTagResult->getXmlTagValue();
                $xmlTagValue = self::ResolveValueByReference($xmlTagValue);
                self::getXmlTagResult($xmlTagKey, $xmlTagResultKey)->setXmlTagValue($xmlTagValue);
            }
        }

        $javaScriptFooterInlineCode = [];
        $result = [];
        $result['canvases'] = [];
        $chartCounter = 0;

        // Processes the plugins
        $javaScriptFooterInlineCode[] = 'Chart.plugins.register([';
        if (is_array(self::$xmlTagResults['plugin'])) {
            foreach (self::$xmlTagResults['plugin'] as $xmlTagResultKey => $xmlTagResult) {
                // Gets the xml tag value
                $pluginFileName = $xmlTagResult->getXmlTagValue();
                if (! file_exists($pluginFileName)) {
                    return self::getController()->addError('error.unknownFile', [
                        $pluginFileName
                    ]);
                }
                $javaScriptFooterInlineCode[] = file_get_contents($pluginFileName) . ',';
            }
        }
        $javaScriptFooterInlineCode[] = ']);';

        // Processes the charts
        foreach (self::$xmlTagResults as $xmlTagKey => $xmlTag) {
            if (array_key_exists($xmlTagKey, self::$allowedChartTags)) {

                foreach ($xmlTag as $xmlTagResultKey => $xmlTagResult) {
                    // Sets the chart id
                    $chartId = $contentObjectUid . '_' . $chartCounter;
                    $chartCounter = $chartCounter + 1;

                    // Gets the xml tag value
                    $xmlTagValue = $xmlTagResult->getXmlTagValue();

                    // Gets the data
                    $data = json_encode(self::getValueFromReference($xmlTagValue['data']));

                    // Gets the options
                    if (empty($xmlTagValue['options'])) {
                        $options = self::$allowedChartTags[$xmlTagKey]['options'];
                    } else {
                        $options = array_merge(self::$allowedChartTags[$xmlTagKey]['options'], self::getValueFromReference($xmlTagValue['options']));
                    }
                    if (empty($options)) {
                        $options = '{}';
                    } else {
                        $options = json_encode($options, JSON_NUMERIC_CHECK);

                        // Processes the callbacks if any
                        $matches = [];
                        if (preg_match_all('/"<!--(###)?(.*?)(###)?-->"/', $options, $matches)) {
                            foreach ($matches[0] as $matchKey => $match) {
                                if (! empty($matches[1][$matchKey])) {
                                    // The call back is provided by its file name
                                    $callbackFileName = str_replace('\/', '/', $matches[2][$matchKey]);
                                    if (! file_exists($callbackFileName)) {
                                        return self::getController()->addError('error.unknownFile', [
                                            $callbackFileName
                                        ]);
                                    }
                                    $options = str_replace($match, file_get_contents($callbackFileName), $options);
                                } else {
                                    $callback = str_replace([
                                        '\n',
                                        '\/'
                                    ], [
                                        chr(10),
                                        '/'
                                    ], $matches[2][$matchKey]);
                                    $options = str_replace($match, $callback, $options);
                                }
                            }
                        }
                    }

                    // Creates the javascript
                    $javaScriptFooterInlineCode[] = 'var canvas' . $chartId . ' = document.getElementById(\'canvas' . $chartId . '\').getContext(\'2d\');';
                    $javaScriptFooterInlineCode[] = 'var chart' . $chartId . ' = new Chart(canvas' . $chartId . ', {type:\'' . self::$allowedChartTags[$xmlTagKey]['type'] . '\', data:' . $data . ', options:' . $options . '});';

                    // Adds the csv file if it exists
                    $csvFileName = '';
                    if (isset($xmlTagValue['csv'])) {
                        $csvFileName = 'typo3temp/sav_charts/img_' . $chartId . '.csv';
                        $fileHandle = fopen(EnvironmentCompatibility::getSitePath() . $csvFileName, 'w');
                        fwrite($fileHandle, $xmlTagValue['csv']);
                        fclose($fileHandle);
                    }

                    $result['canvases'][] = [
                        'chartId' => $chartId,
                        'width' => $xmlTagValue['width'],
                        'height' => $xmlTagValue['height'],
                        'csvFileName' => $csvFileName
                    ];
                }
            }
        }

        $result['javaScriptFooterInlineCode'] = implode(chr(10), $javaScriptFooterInlineCode);

        return $result;
    }

    /**
     * Resolves the value passed by reference
     *
     * @param mixed $xmlTagValue
     * @return mixed
     */
    public static function ResolveValueByReference($xmlTagValue)
    {
        if (is_array($xmlTagValue)) {
            array_walk_recursive($xmlTagValue, 'self::resolveXmlTagValue');
        } else {
            self::resolveXmlTagValue($xmlTagValue);
        }
        return $xmlTagValue;
    }

    /**
     * Resolves xml tag value when the value is an object
     *
     * @param mixed $value
     * @return void
     */
    protected static function resolveXmlTagValue(&$value)
    {
        if ($value instanceof \YolfTypo3\SavCharts\XmlParser\GeneralXmlTag\AbstractXmlTag) {
            $value = $value->getXmlTagValue();
        }
    }

    /**
     * Processes the query
     *
     * @param string $queryManagerName
     *            The query manager name
     * @param string $uid
     *            Identifier for the query
     * @param array $markers
     *            The markers
     *
     * @return array
     */
    public function processQuery(string $queryManagerName, string $uid, array $markers): array
    {
        // Gets the class from the hook
        $hookFound = false;
        if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['sav_charts']['queryManagerClass'])) {
            foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['sav_charts']['queryManagerClass'] as $key => $classRef) {
                if ($key == $queryManagerName) {
                    $hookObject = GeneralUtility::makeInstance($classRef);
                    $hookObject->injectController(self::$controller);
                    $hookFound = true;
                }
            }
        }

        if ($hookFound === false) {
            self::getController()->addError('error.queryManagerMissing', [
                $queryManagerName
            ]);
            return false;
        }

        // Injects the markers
        $hookObject->injectMarkers($markers);

        // Executes the query
        $rows = $hookObject->executeQuery($uid);

        return $rows;
    }

    /**
     * Adds the xml prologue
     *
     * @param $xmlString string
     *            xml string
     *
     * @return string
     */
    protected function addXmlPrologue(string $xmlString): string
    {
        $out = '<?xml version="1.0" encoding="utf-8"?>
      <charts>
      ' . $xmlString . '
      </charts>';

        return $out;
    }

    /**
     * Checks if a string is a reference
     *
     * @param string $reference
     *
     * @return boolean or array
     */
    public static function isReference(string $reference)
    {
        $matches = [];
        if (preg_match('/^(?P<tagName>\w+)#(?P<id>\w+|(?P<idTagName>\w+)#(?P<idId>\w+))(?::(?:(?P<indexNumber>\d+)|(?P<indexWord>value|key)|(?P<indexFor>for)#(?P<indexForId>\w+):(?P<indexForIdIndexWord>key|value))(?:-(?P<endIndexNumber>\d+))?)?$/', $reference, $matches)) {
            return $matches;
        } else {
            return false;
        }
    }

    /**
     * Processes a reference
     *
     * @param string $reference
     *
     * @return mixed (return the reference or false)
     */
    public static function getValueFromReference(string $reference)
    {
        // Get the tag and the id
        $matches = self::isReference($reference);

        if ($matches !== false) {

            if ($matches['idTagName'] && $matches['idId']) {
                $tagName = $matches['idTagName'];
                $id = $matches['idId'];
                $xmlTagResult = XmlParser::getXmlTagResult($tagName, $id);
                if ($xmlTagResult === null) {
                    // The reference is not known yet. Creates a new object.
                    $xmlTagObject = self::getXmlTagObject($tagName);
                    $xmlTagObject->setXmlTagId($id);
                    self::setXmlTagResult($tagName, $id, $xmlTagObject);
                    return $xmlTagObject;
                }
                // Processes the reference
                $id = $xmlTagResult->getXmlTagValue();
            } else {
                $id = $matches['id'];
            }
            $tagName = $matches['tagName'];
            $xmlTagResult = XmlParser::getXmlTagResult($tagName, $id);
            if ($xmlTagResult === null) {
                // The reference is not known yet. Creates a new object.
                $xmlTagObject = self::getXmlTagObject($tagName);
                $xmlTagObject->setXmlTagId($id);
                self::setXmlTagResult($tagName, $id, $xmlTagObject);
                return $xmlTagObject;
            }
            // Processes the reference
            $xmlTagValue = $xmlTagResult->getXmlTagValue();
            if (isset($matches['endIndexNumber'])) {
                // The reference is a range and an array is returned
                $result = [];
                for ($i = $matches['indexNumber']; $i <= $matches['endIndexNumber']; $i ++) {
                    $result[] = $xmlTagValue[$i];
                }
                return $result;
            } elseif (isset($matches['indexFor'])) {
                // The reference is indexed by a for xml tag key or value.
                $xmlForTagResult = XmlParser::getXmlTagResult('for', $matches['indexForId']);
                if ($xmlForTagResult === null) {
                    return self::getController()->addError('error.incorrectReferenceValue', [
                        'for',
                        $matches['indexForId']
                    ]);
                }
                $xmlForTagValue = $xmlForTagResult->getXmlTagValue();
                $index = $xmlForTagValue[$matches['indexForIdIndexWord']];
                return $xmlTagValue[$index];
            } elseif (isset($matches['indexWord']) && $tagName == 'for') {
                // The reference is the curent key or value of a for xml tag.
                $xmlForTagResult = XmlParser::getXmlTagResult('for', $matches['id']);
                if ($xmlForTagResult === null) {
                    return self::getController()->addError('error.incorrectReferenceValue', [
                        'for',
                        $matches['id']
                    ]);
                }
                $xmlForTagValue = $xmlForTagResult->getXmlTagValue();
                $index = $matches['indexWord'];
                return $xmlForTagValue[$index];
            } elseif (isset($matches['indexNumber'])) {
                // The reference is indexed by a value
                return $xmlTagValue[$matches['indexNumber']];
            } else {
                return $xmlTagValue;
            }
        } else {
            return self::getController()->addError('error.referenceNotWellFormed', [
                $reference
            ]);
        }
    }

    /**
     * Replaces special characters
     *
     * @param string $data
     *
     * @return string
     */
    public static function replaceSpecialChars(string $data): string
    {
        $data = str_replace('\r', chr(10), $data);
        $data = str_replace('\n', chr(10), $data);
        $data = str_replace('\t', '&nbsp;&nbsp;&nbsp;&nbsp;', $data);

        return $data;
    }
}

?>
