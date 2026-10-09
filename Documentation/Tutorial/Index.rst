..  include:: ../Includes.txt

..  _tutorial:

=========
Tutorials
=========

Starting with version 14.5.0, SAV Charts comes with two template
parsers and a new plugin interface in the backend. 

..  card-grid::
    :columns: 1
    :columns-md: 2
    :gap: 4
    :class: pb-4
    :card-height: 100

    ..  card:: :ref:`Plugin Interface<pluginInterface>`

        The plugin contains a Flexform for configuring
        the Fluid and XML Parsers. Both codes can exist
        simultaneously.
        If you already have XML code on your web
        server, an updater will transfer the original
        to the XML Parser tab. An automatic conversion
        will also be introduced to the Fluid Parser
        tab. A debug feature and a converter have
        been introduced in the Fluid Parser.

    ..  card:: :ref:`Designing Templates<DesigningTemplatesTutorial>`

        Learn how to:
        
        -   :ref:`Design templates from JavaScript examples <designingTemplatesFromExamples>`.
        -   :ref:`Use the converter <usingTheConverter>`.
        -   :ref:`Use advanced templates <usingAdvancedTemplates>`.
        -   :ref:`Convert XML templates to Fluid templates <convertingXmlTemplatesToFluidTemplates>`.
        
    ..  card:: :ref:`Using other libraries<UsingOtherLibrariesTutorial>`

        Learn how to generate charts using the following libraries:
        
        -   ECharts
        -   Apache ECharts
        -   Plotly.

    ..  card:: :ref:`Other features<OtherFeaturesTutorial>`

        Learn how to:
        
        -   :ref:`Export data in CSV format <exportingDataInCsv>`.
        -   :ref:`Use and develop query managers <usingAndDevelopingQueryManagers>`.
        -   :ref:`Import data using spreadsheets <usingSpreadsheets>`.
        -   :ref:`Include charts directly in
            HTML templates <includingChartsInHtmlTemplates>`. 


Table of Contents
=================

..  toctree::
    :maxdepth: 5
    :titlesonly:
    :glob:
   
    PluginInterface/Index
    DesigningTemplates/Index
    UsingOtherLibraries/Index
    OtherFeatures/Index
