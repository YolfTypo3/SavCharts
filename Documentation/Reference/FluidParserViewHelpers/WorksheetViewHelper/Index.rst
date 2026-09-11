..  include:: ../../../Includes.txt

..  _worksheetViewHelper:

:navigation-title: worksheet

==================================
Worksheet ViewHelper <c:worksheet>
==================================

ViewHelper that defines the worksheet to use in a spreadsheet.

Go to the source code of this ViewHelper: 
`WorksheetViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/WorksheetViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the worksheet ViewHelper: 

..  confval:: name
    :name: worksheetName
    :Type: string
    :required: true
    
    Worksheet name

Examples
========

..  code-block:: xml

    <c:spreadsheet fileName="EXT:sav_charts/Resources/Private/Templates/ChartsExamples/Spreadsheet.xlsx"> 
        <c:worksheet name="Example2">
        
        </c:worksheet> 
    </c:spreadsheet>   

