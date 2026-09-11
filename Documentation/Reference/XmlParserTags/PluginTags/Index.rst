..     include:: ../../../Includes.txt

..     _pluginTags:


===========
Plugin Tags
===========

..     only:: html

..     _plugin.plugin:

..     confval:: plugin

    ..  code-block:: xml
    
        <plugin chartId="myChart#id" key="pluginKey" fileName="pluginFileName" /">
    
    :Type: Object
    :Description:
        Loads the JavaScript file (see the FAQ section).
    :Attributes:
        - chartId (required): the chart identifier.  
        - pluginKey (required): the plugin key.  
        - fileName (required): The file name of the JavaScript function.
