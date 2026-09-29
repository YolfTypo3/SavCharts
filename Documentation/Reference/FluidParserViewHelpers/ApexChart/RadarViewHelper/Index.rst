..  include:: ../../../../Includes.txt

..  _apexchart.radarViewHelper:

:navigation-title: apexchart.radar

====================================
Radar ViewHelper <c:apexchart.radar>
====================================

ViewHelper to include a radar chart with `ApexCharts`.

Go to the source code of this ViewHelper: 
`RadarViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/ApexChart/RadarViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/ApexChartsExamples/RadarChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ApexCharts/radarChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: apexchart.radarId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: apexchart.radarOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: apexchart.radarWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: apexchart.radarHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Radar Chart
-----------------------

..  code-block:: xml    

    <c:apexcharts>
        <c:apexchart.radar id="1" options="data__radarChartOptions" >
            ...
        </c:apexchart.radar>
    </c:apexcharts>
    