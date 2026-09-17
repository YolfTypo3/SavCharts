..  include:: ../../../../Includes.txt

..  _echart.pieViewHelper:

:navigation-title: echart.pie

=============================
Pie ViewHelper <c:echart.pie>
=============================

ViewHelper to include a pie chart with `Apache ECharts`.

Go to the source code of this ViewHelper: 
`PieViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/EChart/PieViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/EChartsExamples/PieChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ECharts/pieChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: echart.pieId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: echart.pieOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: echart.pieWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: echart.pieHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Pie Chart
--------------------

..  code-block:: xml    

    <c:echarts>
        <c:echart.pie id="1" options="data__pieChartOptions" >
            ...
        </c:echart.pie>
    </c:echarts>
    