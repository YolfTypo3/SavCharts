..  include:: ../../../../Includes.txt

..  _backgroundColorViewHelper:

:navigation-title: cell.backgroundColor

===================================================
BackgroundColor ViewHelper <c:cell.backgroundColor>
===================================================

ViewHelper that returns the background color of a cell.

Go to the source code of this ViewHelper: 
`BackgroundColorViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/Cell/BackgroundColorViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the backgroundColor ViewHelper: 

..  confval:: address
    :name: backgroundColorAddress
    :Type: string
    :required: true
    
    Address of the cell
    
..  confval:: alpha
    :name: backgroundColorAlpha
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
                <c:item key="0" value="{c:cell.backgroundcolor(address:'B14')}" />
            </c:data>
            
            <c:data id="hoverBackgroundColor">
                <c:item key="0" value="{c:cell.backgroundcolor(address:'B14', alpha:50)}" />
            </c:data>   
            
        </c:worksheet> 
    </c:spreadsheet> 