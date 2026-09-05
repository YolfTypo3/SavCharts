..  include:: ../../Includes.txt

..  _ParsersTutorial:

=======
Parsers
=======

The XML parser is a parser that was developed
for TYPO3 6.2 and later versions. Based mainly 
on the PHP class SimpleXMLElement, it provides 
fast chart generation. However, the PHP code is
complex. XML templates lack readability when 
iterative processing is required.

The new Fluid parser is entirely based on Fluid 
syntax and viewHelpers. Since all Fluid viewHelpers
can be used (e.g. <f:for>, <f:if>, and <f:variable>)
the Fluid parser results in simpler templates when
iterative processing is required. It also provides 
simpler PHP code and makes it possible to use or
develop other viewHelpers. 

Table of Contents
=================

..  toctree::
    :maxdepth: 5
    :titlesonly:
    :glob:

    DesigningTemplatesFromExamples/Index
    UsingAdvancedTemplates/Index
    UsingAndDevelopingQueryManagers/Index
    ExportingDataInCSV/Index
    ConvertingBasicXmlTemplatesToFluidTemplates/Index
    ConvertingAdvancedXmlTemplatesToFluidTemplates/Index
    IncludingChartsInHtmlTemplates/Index


















