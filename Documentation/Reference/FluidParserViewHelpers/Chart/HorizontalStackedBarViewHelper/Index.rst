..  include:: ../../../../Includes.txt

..  _horizontalStackedBarViewHelper:

:navigation-title: chart.horizontalStackedBar

==============================================================
HorizontalStackedBar ViewHelper <c:chart.horizontalStackedBar>
==============================================================

ViewHelper to include a horizontalStackedBar chart with `Charts.js`.

Go to the source code of this ViewHelper: 
`HorizontalStackedBarViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/Chart/HorizontalStackedBarViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/ChartsExamples/FluidParser/HorizontalStackedBarChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/Charts/horizontalStackedBarChart.png
    :width: 40% 
    
Arguments
=========

..  confval:: id
    :name: horizontalStackedBarId
    :Type: string
    :required: true
    
    Chart ID    

..  confval:: data
    :name: horizontalStackedBarData
    :Type: mixed
    :required: true

    Data, or a reference to data
    
..  confval:: options
    :name: horizontalStackedBarOptions
    :Type: mixed
    
    Options, or a reference to options    
    
..  confval:: width
    :name: horizontalStackedBarWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: horizontalStackedBarHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a horizontalStackedBar Chart
-------------------------------------

..  code-block:: xml    

    <c:charts>
        <c:chart.horizontalStackedBar id="1" data="data__horizontalStackedBarChartData" options="data__horizontalStackedBarChartOptions" >
            ...
        </c:chart.horizontalStackedBar>
    </c:charts>
    