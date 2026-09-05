..  include:: ../../../Includes.txt

..  _chartViewHelpers:

===========================
Available Chart ViewHelpers
===========================

The following ViewHelpers may be used to build charts:

-    <c:barChart>
-    <c:bubbleChart> 
-    <c:doughnutChart>
-    <c:horizontalBarChart>
-    <c:horizontalStackedBarChart>
-    <c:lineChart>
-    <c:pieChart>
-    <c:polarAreaChart>
-    <c:radarChart>
-    <c:scatterBarChart>
-    <c:stackedBarChart>

All of them have the same arguments.

..  note::
    
    The types available in Charts.js are only bar, bubble, doughnut,
    line, pie, polarArea, radar, and scatter.
    
    Therefore, the horizontalBarChart, horizontalStackedBarChart
    and stackedBarChart facilities were introduced to avoid 
    the need to configure the bar type.

Example
=======

..  code-block:: xml    
    
    <c:barChart id="1" data="data__barChartData" options="data__barChartOptions" width="600" height="400">
        ...
    </c:barChart>
    
Arguments
=========

..  confval:: id
    :name: chartId
    :Type: string
    :required: true
    
    Chart ID    

..  confval:: data
    :name: chartData
    :Type: mixed
    :required: true

    Data, or a reference to data
    
..  confval:: options
    :name: chartOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: chartWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: chartHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

