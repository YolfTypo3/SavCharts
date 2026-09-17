..  include:: ../../../Includes.txt

..  _echartsViewHelper:

:navigation-title: echarts

==============================
ECharts ViewHelper <c:echarts>
==============================

Root ViewHelper to include charts with `Apache ECharts`.

Go to the source code of this ViewHelper: 
`EChartsViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/EChartsViewHelper.php>`_ (GitHub). 

Arguments
=========

The echarts ViewHelper has no argument.


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
    
