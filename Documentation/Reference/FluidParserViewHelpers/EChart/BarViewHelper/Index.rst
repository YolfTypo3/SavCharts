..  include:: ../../../../Includes.txt

..  _echart.barViewHelper:

:navigation-title: echart.bar

=============================
Bar ViewHelper <c:echart.bar>
=============================

ViewHelper to include a bar chart with `Apache ECharts`.

Go to the source code of this ViewHelper: 
`BarViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/EChart/BarViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/EChartsExamples/BarChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ECharts/barChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: echart.barId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: echart.barOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: echart.barWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: echart.barHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Bar Chart
--------------------

..  code-block:: xml    

    <c:echarts>
        <c:echart.bar id="1" options="data__barChartOptions" >
            ...
        </c:echart.bar>
    </c:echarts>
    