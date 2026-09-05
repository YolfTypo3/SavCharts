..  include:: ../../../Includes.txt

..  _exportCsvViewHelper:

:navigation-title: ExportCsv ViewHelper

====================================
ExportCsv ViewHelper `<c:exportCsv>`
====================================

ViewHelper that exports data in CSV format.

Go to the source code of this ViewHelper: 
`ExportCsvViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/ExportCsvViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the exportCsv ViewHelper: 

..  confval:: data
    :name: csvExportData
    :Type: mixed
    :required: true
    
    Data to export
    
..  confval:: fileName
    :name: csvExportFilename
    :Type: string
    :required: true
    
    File name to save the CSV in typo3temp/sav_charts        

..  confval:: columnHeader
    :name: csvExportColumnHeader
    :Type: array
    
    Column header    

..  confval:: rowHeader
    :name: csvExportRowHeader
    :Type: array
    
    Row header

Examples
========

Exporting data with a column header
-----------------------------------

..  code-block:: xml

    <c:data id="data">
          <c:item key="0" values="65, 59, 80, 81, 56, 55, 40" />
          <c:item key="1"values="1.5, 3, 5, 10, 17, 20, 24" />  
    </c:data>

    <c:template id="1">
        EXT:sav_charts/Resources/Private/Templates/ChartsExamples/FluidParser/HorizontalBarChartAdvanced.fluid
    </c:template>

             
    <c:exportCSV fileName="Export_1.csv" columnHeader="{data__labels}" data="{data__data}" /> 

Exporting data with a column header and a row header
----------------------------------------------------

..  code-block:: xml
    
    <c:marker id="labelSet0">Humidity</c:marker>
    <c:marker id="labelSet1">Temperature</c:marker>

    <c:exportCSV fileName="Export_2.csv" rowHeader="{0:'', 1:marker__labelSet0, 2:marker__labelSet1}" columnHeader="{data__labels}" data="{data__data}" /> 

Exporting transposed data with a column header
----------------------------------------------

..  code-block:: xml

    <c:exportCSV fileName="Export_3.csv" columnHeader="{0:marker__labelSet0, 1:marker__labelSet1}" data="{data__data->c:transpose()}" /> 

    