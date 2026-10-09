..  include:: ../../../Includes.txt

..  _plotlychartsViewHelper:

:navigation-title: plotlycharts

========================================
PlotlyCharts ViewHelper <c:plotlycharts>
========================================

Root ViewHelper to include charts with `Plotly`.

Go to the source code of this ViewHelper: 
`PlotlyChartsViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/PlotlyChartsViewHelper.php>`_ (GitHub). 

Arguments
=========

The charts ViewHelper has no argument.


Examples
========

Defining a Bar Chart
--------------------

..  code-block:: xml    

    <c:plotlycharts>
        <c:plotlychart.bar id="1" data="data__barChartData" options="data__barChartOptions" >
            ...
        </c:plotlychart.bar>
    </c:plotlycharts>
    
