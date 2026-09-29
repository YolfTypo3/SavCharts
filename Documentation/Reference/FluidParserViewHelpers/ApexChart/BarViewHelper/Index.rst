..  include:: ../../../../Includes.txt

..  _apexchart.barViewHelper:

:navigation-title: apexchart.bar

================================
Bar ViewHelper <c:apexchart.bar>
================================

ViewHelper to include a bar chart with `ApexCharts`.

Go to the source code of this ViewHelper: 
`BarViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/ApexChart/BarViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/ApexChartsExamples/BarChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ApexCharts/barChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: apexchart.barId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: apexchart.barOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: apexchart.barWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: apexchart.barHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Bar Chart
--------------------

..  code-block:: xml    

    <c:apexcharts>
        <c:apexchart.bar id="1" options="data__barChartOptions" >
            ...
        </c:apexchart.bar>
    </c:apexcharts>
    