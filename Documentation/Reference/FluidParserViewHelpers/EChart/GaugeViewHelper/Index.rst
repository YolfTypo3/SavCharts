..  include:: ../../../../Includes.txt

..  _echart.gaugeViewHelper:

:navigation-title: echart.gauge

=================================
Gauge ViewHelper <c:echart.gauge>
=================================

ViewHelper to include a gauge chart with `Apache ECharts`.

Go to the source code of this ViewHelper: 
`GaugeViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/EChart/GaugeViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/EChartsExamples/GaugeChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ECharts/gaugeChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: echart.gaugeId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: echart.gaugeOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: echart.gaugeWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: echart.gaugeHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Gauge Chart
-----------------------

..  code-block:: xml    

    <c:echarts>
        <c:echart.gauge id="1" options="data__gaugeChartOptions" >
            ...
        </c:echart.gauge>
    </c:echarts>
    