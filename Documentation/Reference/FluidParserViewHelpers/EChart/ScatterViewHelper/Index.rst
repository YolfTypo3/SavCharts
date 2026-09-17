..  include:: ../../../../Includes.txt

..  _echart.scatterViewHelper:

:navigation-title: echart.scatter

=====================================
Scatter ViewHelper <c:echart.scatter>
=====================================

ViewHelper to include a scatter chart with `Apache ECharts`.

Go to the source code of this ViewHelper: 
`ScatterViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/EChart/ScatterViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/EChartsExamples/ScatterChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ECharts/scatterChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: echart.scatterId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: echart.scatterOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: echart.scatterWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: echart.scatterHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Scatter Chart
------------------------

..  code-block:: xml    

    <c:echarts>
        <c:echart.scatter id="1" options="data__scatterChartOptions" >
            ...
        </c:echart.scatter>
    </c:echarts>
