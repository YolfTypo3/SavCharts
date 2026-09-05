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
        the XML and Fluid parsers. Both codes can exist
        simultaneously.
        If you already have XML code on your web
        server, an updater will transfer the original
        to the XML parser tab. An automatic conversion
        will also be introduced to the Fluid parser
        tab. A debug feature has been introduced
        in the Fluid parser.

    ..  card:: :ref:`Parsers<ParsersTutorial>`

        Based mainly on the PHP class SimpleXMLElement,
        The XML parser provides fast chart generation. 
        
        The Fluid Parser is a new parser based solely
        on Fluid syntax and specific viewHelpers.


..  toctree::
    :maxdepth: 5
    :titlesonly:
    :glob:
   
    PluginInterface/Index
    ParsersTutorial/Index
