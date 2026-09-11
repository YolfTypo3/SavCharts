..  include:: ../../../../Includes.txt

..  _valueViewHelper:

:navigation-title: cell.value

===============================
Value ViewHelper <c:cell.value>
===============================

ViewHelper that returns the value of a cell.

Go to the source code of this ViewHelper: 
`ValueViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/Cell/ValueViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the value ViewHelper: 

..  confval:: address
    :name: valueAddress
    :Type: string
    :required: true
    
    Address of the cell

Examples
========

Inline
------

..  code-block:: xml

    <c:spreadsheet fileName="EXT:sav_charts/Resources/Private/Templates/ChartsExamples/Spreadsheet.xlsx"> 
        <c:worksheet name="Example2">
            <c:marker id="title">{c:cell.value(address:'A2')}</c:marker>        
        </c:worksheet> 
    </c:spreadsheet>  

