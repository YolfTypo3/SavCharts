<?php
declare(strict_types=1);

namespace YolfTypo3\SavCharts\Upgrades;

use TYPO3\CMS\Core\Configuration\FlexForm\FlexFormTools;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

#[UpgradeWizard('savChartsPiFlexformUpgradeWizard')]
final class PiFlexformUpgradeWizard implements UpgradeWizardInterface
{
    private const TABLE = 'tt_content';
    private const PLUGIN = 'savcharts_default';
    
    public function __construct(
        private readonly ConnectionPool $connectionPool,
        private readonly FlexFormTools $flexFormTools,
        ) {}
        
        public function getTitle(): string
        {
            return '[sav_charts] Migrate pi_flexform field.';
        }
        
        public function getDescription(): string
        {
            return 'Migrate tt_content pi_flexform to keep compatibility with XML Parser';
        }
        
        public function executeUpdate(): bool
        {
            $result = 0;
            $result += $this->migratePlugin(self::PLUGIN);
            return $result > 0;
        }
        
        private function migratePlugin(string $plugin): int
        {
            $updated = 0;
            $queryBuilder = $this->connectionPool->getQueryBuilderForTable(self::TABLE);
            $result = $queryBuilder
                ->select('*')
                ->from(self::TABLE)
                ->where(
                    $queryBuilder->expr()->eq('CType', $queryBuilder->createNamedParameter($plugin)),
                    )
                ->executeQuery();
            
            while ($row = $result->fetchAssociative()) {
                $flexform = $row['pi_flexform'];
                if (!is_string($flexform ?? false)) {
                    continue;
                }
                
                $xml = new \SimpleXMLElement($flexform);

                $xmlParserSheet = $xml->xpath('//sheet[@index="xmlParser"]');
                if (empty($xmlParserSheet)) {
                    // Renames the sDEF sheet en xmlParser.
                    $sheet = $xml->xpath('//sheet[@index="sDEF"]');
                       
                    // Checks if the element exists.
                    if (!empty($sheet)) {
                        // Replaces the index attribute.
                        $sheet[0]->attributes()->index = 'xmlParser';
                    }
                    
                    // Removes the allowQueries node in xmlParser sheet.
                    $nodes = $xml->xpath('//sheet[@index="xmlParser"]/language[@index="lDEF"]/field[@index="settings.flexform.allowQueries"]');
                    $allowQueriesValue = (string)$nodes[0]->value;
                    
                    // Checks if the node exists and remove it.
                    if (!empty($nodes)) {
                        foreach ($nodes as $node) {
                            $dom = dom_import_simplexml($node);
                            $dom->parentNode->removeChild($dom);
                        }
                    }
                    
                    // Copies the sheet xmlParser in fluidParser.
                    $sheet = $xml->xpath('//sheet[@index="fluidParser"]');
                    if (empty($sheet)) {
                        $existingSheet = $xml->xpath('//sheet[@index="xmlParser"]')[0];
                        
                        if (!empty($existingSheet)) {
                            // @extensionScannerIgnoreLine
                            $newSheet = $xml->data->addChild('sheet');
                            $newSheet->addAttribute('index', 'fluidParser');
                            $newSheet = $xml->xpath('//sheet[@index="fluidParser"]')[0];
                            
                            $this->copyNode($existingSheet, $newSheet);    
                        }
                    }
                    $sheet = $xml->xpath('//sheet[@index="fluidParser"]/language[@index="lDEF"]/field');
                    // Change attributes.
                    $nodes = $xml->xpath('//sheet[@index="fluidParser"]/language[@index="lDEF"]/field[@index="settings.flexform.xmlMarkersConfig"]');
                    if (!empty($nodes)) {
                        $nodes[0]->attributes()->index = 'settings.flexform.fluidMarkersConfig';
                    }
                    $nodes = $xml->xpath('//sheet[@index="fluidParser"]/language[@index="lDEF"]/field[@index="settings.flexform.xmlQueriesConfig"]');
                    if (!empty($nodes)) {
                        $nodes[0]->attributes()->index = 'settings.flexform.fluidQueriesConfig';
                    }
                    $nodes = $xml->xpath('//sheet[@index="fluidParser"]/language[@index="lDEF"]/field[@index="settings.flexform.xmlDataConfig"]');
                    if (!empty($nodes)) {
                        $nodes[0]->attributes()->index = 'settings.flexform.fluidDataConfig';
                    }
                    $nodes = $xml->xpath('//sheet[@index="fluidParser"]/language[@index="lDEF"]/field[@index="settings.flexform.xmlTemplatesConfig"]');
                    if (!empty($nodes)) {
                        $nodes[0]->attributes()->index = 'settings.flexform.fluidTemplatesConfig';
                    }
                    
                    // Changes the extension file into .fluid.
                    $nodes = $xml->xpath('//sheet[@index="fluidParser"]/language[@index="lDEF"]/field[@index="settings.flexform.fluidTemplatesConfig"]/value[@index="vDEF"]');
                    if ($nodes) {
                        foreach ($nodes as $node) {
                            $node[0] = str_replace('.xml', '.fluid', (string)$node[0]);
                        }
                    }
                    
                    // Creates the sDEF sheet.
                    $sheet = $xml->xpath('//sheet[@index="sDEF"]');
                    if (empty($sheet)) {                    
                        // Creates a new <sheet> node.
                        // @extensionScannerIgnoreLine
                        $newSheet = $xml->data->addChild('sheet');
                        $newSheet->addAttribute('index', 'sDEF');
                        
                        // Create a new <language> node
                        $newLanguage = $newSheet->addChild('language');
                        $newLanguage->addAttribute('index', 'lDEF');
                        
                        // Creates a new <field> node.
                        $newField = $newLanguage->addChild('field');
                        $newField->addAttribute('index', 'settings.flexform.allowQueries');
                        
                        // Creates a new <value> node.
                        $newValue = $newField->addChild('value', $allowQueriesValue);
                        $newValue->addAttribute('index', 'vDEF');
    
                        // Creates a new <field> node.
                        $newField = $newLanguage->addChild('field');
                        $newField->addAttribute('index', 'settings.flexform.parserType');
    
                        // Creates a new <value> node.
                        $newValue = $newField->addChild('value', '0');
                        $newValue->addAttribute('index', 'vDEF');                 
                    }                
                    $flexform = $xml->asXML();
                    $updated++;
                    $this->connectionPool->getConnectionForTable('tt_content')
                        ->update(
                            self::TABLE,
                            [ // set
                                'pi_flexform' => $flexform,
                            ],
                            [ // where
                                'uid' => (int)$row['uid'],
                            ],
                        );
                } else {
                    $updated++;
                }
            }
            return $updated;
        }
        
        // Recursive function to copy a node and its children.
        protected function copyNode($source, $destination) {
            foreach ($source->children() as $child) {
                $newChild = $destination->addChild($child->getName());
                // Copies the attribute.
                foreach ($child->attributes() as $attr => $value) {
                    $newChild->addAttribute($attr, (string)$value);
                }
                // Copies the contenu and add c:.
                if (trim((string)$child) !== '') {
                    $content = preg_replace('/<([^\/])/', '<c:$1', (string)$child);
                    $content = preg_replace('/<\//', '</c:', $content);
                    $newChild[0] = $content;
                }
                $this->copyNode($child, $newChild);
            }
        }
        
        public function updateNecessary(): bool
        {
            $queryBuilder = $this->connectionPool->getQueryBuilderForTable(self::TABLE);
            $queryBuilder->getRestrictions()->removeAll();

            return (bool)$queryBuilder
            ->count('uid')
            ->from(self::TABLE)
            ->where(
                $queryBuilder->expr()->eq('CType', $queryBuilder->createNamedParameter(self::PLUGIN)),
                )
                ->executeQuery()
                ->fetchOne();
        }
        
        /**
         * @return string[]
         */
        public function getPrerequisites(): array
        {
            return [];
        }
}
