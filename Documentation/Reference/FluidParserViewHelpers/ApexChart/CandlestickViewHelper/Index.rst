..  include:: ../../../../Includes.txt

..  _apexchart.candlestickViewHelper:

:navigation-title: apexchart.candlestick

================================================
Candlestick ViewHelper <c:apexchart.candlestick>
================================================

ViewHelper to include a candlestick chart with `ApexCharts`.

Go to the source code of this ViewHelper: 
`CandlestickViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/ApexChart/CandlestickViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/ApexChartsExamples/CandlestickChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ApexCharts/candlestickChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: apexchart.candlestickId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: apexchart.candlestickOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: apexchart.candlestickWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: apexchart.candlestickHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Candlestick Chart
----------------------------

..  code-block:: xml    

    <c:apexcharts>
        <c:apexchart.candlestick id="1" options="data__candlestickChartOptions" >
            ...
        </c:apexchart.candlestick>
    </c:apexcharts>
    