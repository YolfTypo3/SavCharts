..  include:: ../../../../Includes.txt

..  _colorViewHelper:

:navigation-title: cell.color

===============================
Color ViewHelper <c:cell.color>
===============================

ViewHelper that returns the font color of a cell.

Go to the source code of this ViewHelper: 
`ColorViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/Cell/ColorViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the color ViewHelper: 

..  confval:: address
    :name: colorAddress
    :Type: string
    :required: true
    
    Address of the cell
    
..  confval:: alpha
    :name: colorAlpha
    :Type: int [0..100]

    If set, it modifies the transparency    

Examples
========

Inline
------

..  code-block:: xml

    <c:spreadsheet fileName="EXT:sav_charts/Resources/Private/Templates/ChartsExamples/Spreadsheet.xlsx"> 
        <c:worksheet name="Example2">

            <c:data id="backgroundColor">
                <c:item key="0" value="{c:cell.color(address:'B2')}" />
            </c:data>
            
            <c:data id="hoverBackgroundColor">
                <c:item key="0" value="{c:cell.color(address:'B2', alpha:50)}" />
            </c:data>   
            
        </c:worksheet> 
    </c:spreadsheet>  
