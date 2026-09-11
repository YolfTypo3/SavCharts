..  include:: ../../../Includes.txt

..  _markerViewHelper:

:navigation-title: marker

============================
Marker ViewHelper <c:marker>
============================

ViewHelper that defines markers.

Go to the source code of this ViewHelper: 
`MarkerViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/MarkerViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the marker ViewHelper: 

..  confval:: id
    :name: markerId
    :Type: string
    :required: true
    
    Marker ID    

..  confval:: value
    :name: markerValue
    :Type: string

    Marker value
    
..  confval:: reload
    :name: markerReload
    :Type: boolean
    :default: false
    
    If true, the marker is reloaded if it exists
        
Examples
========

With value attribute
--------------------

..  code-block:: xml    
    
    <c:marker id="width" value="600" />
    
Child nodes
-----------    

..  code-block:: xml    
    
    <c:marker id="width">600</c:marker>
