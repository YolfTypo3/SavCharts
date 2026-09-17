..  include:: ../../../../Includes.txt

..  _barViewHelper:

:navigation-title: chart.bar

============================
Bar ViewHelper <c:chart.bar>
============================

ViewHelper to include a bar chart with `Charts.js`.

Go to the source code of this ViewHelper: 
`BarViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/Chart/BarViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/ChartsExamples/FluidParser/BarChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/Charts/barChart.png
    :width: 40%  
    
Arguments
=========

..  confval:: id
    :name: barId
    :Type: string
    :required: true
    
    Chart ID    

..  confval:: data
    :name: barData
    :Type: mixed
    :required: true

    Data, or a reference to data
    
..  confval:: options
    :name: barOptions
    :Type: mixed
    
    Options, or a reference to options    
    
..  confval:: width
    :name: barWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: barHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Bar Chart
--------------------

..  code-block:: xml    

    <c:charts>
        <c:chart.bar id="1" data="data__barChartData" options="data__barChartOptions" >
            ...
        </c:chart.bar>
    </c:charts>
    