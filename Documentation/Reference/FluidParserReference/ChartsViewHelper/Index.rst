..  include:: ../../../Includes.txt

..  _chartsViewHelper:

:navigation-title: Charts ViewHelper

============================
Charts ViewHelper <c:charts>
============================

Root ViewHelper to include charts.

Go to the source code of this ViewHelper: 
`ChartsViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/ChartsViewHelper.php>`_ (GitHub). 

Arguments
=========

The charts ViewHelper has no argument.


Examples
========

Defining a Bar Chart
--------------------

..  code-block:: xml    

    <c:charts>
        <c:barChart id="1" data="data__barChartData" options="data__barChartOptions" >
            ...
        </c:barChart>
    </c:charts>
    
