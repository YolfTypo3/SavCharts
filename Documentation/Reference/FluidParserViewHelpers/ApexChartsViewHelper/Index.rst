..  include:: ../../../Includes.txt

..  _apexchartsViewHelper:

:navigation-title: apexcharts

====================================
ApexCharts ViewHelper <c:apexcharts>
====================================

Root ViewHelper to include charts with `ApexCharts`.

Go to the source code of this ViewHelper: 
`ApexChartsViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/ApexChartsViewHelper.php>`_ (GitHub). 

Arguments
=========

The apexcharts ViewHelper has no argument.


Examples
========

Defining a Bar Chart
--------------------

..  code-block:: xml    

    <c:apexcharts>
        <c:apexchart.bar id="1" options="data__barChartOptions" >
            ...
        </c:apexchart.bar>
    </c:apexcharts>
    
