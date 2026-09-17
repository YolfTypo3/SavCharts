..  include:: ../../../../Includes.txt

..  _echart.radarViewHelper:

:navigation-title: echart.radar

=================================
Radar ViewHelper <c:echart.radar>
=================================

ViewHelper to include a radar chart with `Apache ECharts`.

Go to the source code of this ViewHelper: 
`RadarViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/EChart/RadarViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/EChartsExamples/RadarChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ECharts/radarChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: echart.radarId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: echart.radarOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: echart.radarWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: echart.radarHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Radar Chart
-----------------------

..  code-block:: xml    

    <c:echarts>
        <c:echart.radar id="1" options="data__radarChartOptions" >
            ...
        </c:echart.radar>
    </c:echarts>
    