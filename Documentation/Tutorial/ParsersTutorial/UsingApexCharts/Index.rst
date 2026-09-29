..  include:: ../../../Includes.txt

..  _usingApexCharts:

================
Using ApexCharts
================

ViewHelpers for `ApexCharts` were introduced
in version 14.8.0 of SAV Charts. 
Charts must be created using the <c:apexcharts>
viewHelpers instead of <c:charts> with `Charts.js`.

..  important::

    The Community Licence is free for individuals,
    non-profits, educators, and small businesses 
    with less than $2 million USD in annual 
    revenue. Please read `License Options for ApexCharts
    <https://apexcharts.com/license/>`_.
    
    
Since `ApexCharts`
is also a JavaScript library, the concepts used
in `Charts.js`, or `Apache Echarts` are exactly the same. All the 
viewHelpers can be used, except <c:charts> and its children, or 
<c:echarts> and its children. Therefore, data can be imported
via queries or spreadsheets, just as with `Charts.js`.
 
Several viewHelpers are provided 
to get started with this library. For example, 
the viewHelper <c:apexcharts.bar> is used
to create a bar chart, whereas
<c:charts.bar> is used with `Charts.js`, and
<c:echarts.bar> is used with `Apache ECharts`.

Several examples of basic charts are provided 
in the directory
`Resources/Private/Templates/ApexChartsExamples`.
All of the provided examples were
converted from the 
`ApexCharts JavaScript Chart Demos section <https://apexcharts.com/javascript-chart-demos>`_.
For instance, adding the following code in the
Template field of the plugin Flexform generates
a basic bar chart. 

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/ApexChartsExamples/BarChart.fluid"
    </c:template>

..  figure:: ../../../Images/ScreenShots/ApexCharts/barChart.png
    :width: 50%   
