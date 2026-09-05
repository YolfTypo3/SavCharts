..  include:: ../../../Includes.txt

..  _dataViewHelper:

:navigation-title: Data ViewHelper

========================
Data ViewHelper <c:data>
========================

ViewHelper which defines data.

Go to the source code of this ViewHelper: 
`DataViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/DataViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the data ViewHelper: 

..  confval:: id
    :name: dataId
    :Type: string
    :required: true
    
    Data ID    

..  confval:: values
    :name: dataValues
    :Type: mixed
    
Examples
========

With values attribute
---------------------

..  code-block:: xml

    <c:data id="size" values="12" />
    <c:data id="columnHeader" values="{data__labels}" />
        
        
Child nodes
-----------

..  code-block:: xml

    <c:data id="dataSets">
        <c:item key="0" value="{data__set0}" />
        <c:item key="1" value="{data__set1}" />
    </c:data>

..  code-block:: xml
    
    <c:data id="labels">
        January, February, March, April, May, June, July
    </c:data>

..  note::
    
    ..  code-block:: xml
        
        <c:data id="example1" values="A, B, C, D" />
        
    is equivalent to

    ..  code-block:: xml    
        
        <f:variable name="data__example1" value="A, B, C, D" />
        
    but 
    
    ..  code-block:: xml    
        
        <c:data id="example2">A, B, C, D</c:data>

    is equivalent to

    ..  code-block:: xml    
                
        <f:variable name="data__example2" value="{0:'A', 1:'B', 2:'C', 3:'D'}" />