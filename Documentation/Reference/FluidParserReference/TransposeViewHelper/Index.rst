..  include:: ../../../Includes.txt

..  _transposeViewHelper:

:navigation-title: Transpose ViewHelper

==================================
Transpose ViewHelper <c:transpose>
==================================

ViewHelper that transposes data.

Go to the source code of this ViewHelper: 
`TransposeViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/TranposeViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the transpose ViewHelper: 

..  confval:: data
    :name: transposeData
    :Type: array
    :required: true
    
    Data to transpose

Examples
========

With data attribute
-------------------

..  code-block:: xml

    <c:data id="data">
        <c:item key="0" values="65, 59, 80, 81, 56, 55, 40" />
        <c:item key="1"values="1.5, 3, 5, 10, 17, 20, 24" />  
    </c:data>
    
    <f:variable name="tranposedData"><c:transpose data="{data__data}" /></f:variable>
    
Inline
------

..  code-block:: xml

    <c:data id="data">
        <c:item key="0" values="65, 59, 80, 81, 56, 55, 40" />
        <c:item key="1"values="1.5, 3, 5, 10, 17, 20, 24" />  
    </c:data>
    
    <f:variable name="tranposedData" value="{data__data->c:transpose()}" />

