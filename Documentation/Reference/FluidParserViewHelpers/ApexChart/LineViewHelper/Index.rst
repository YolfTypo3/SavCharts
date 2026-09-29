..  include:: ../../../../Includes.txt

..  _apexchart.lineViewHelper:

:navigation-title: apexchart.line

==================================
Line ViewHelper <c:apexchart.line>
==================================

ViewHelper to include a line chart with `ApexCharts`.

Go to the source code of this ViewHelper: 
`LineViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/ApexChart/LineViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/ApexChartsExamples/LineChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ApexCharts/lineChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: apexchart.lineId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: apexchart.lineOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: apexchart.lineWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: apexchart.lineHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Line Chart
---------------------

..  code-block:: xml    

    <c:apexcharts>
        <c:apexchart.line id="1" options="data__lineChartOptions" >
            ...
        </c:apexchart.line>
    </c:apexcharts>
    