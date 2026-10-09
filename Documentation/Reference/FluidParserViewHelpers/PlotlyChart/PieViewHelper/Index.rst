..  include:: ../../../../Includes.txt

..  _plotlychart.pieViewHelper:

:navigation-title: plotlychart.pie

==================================
Pie ViewHelper <c:plotlychart.pie>
==================================

ViewHelper to include a pie chart with `Plotly`.

Go to the source code of this ViewHelper: 
`PieViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/PlotlyChart/PieViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/PlotlyChartsExamples/PieChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/PlotlyCharts/pieChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: plotlychart.pieId
    :Type: string
    :required: true
    
    Chart ID 
       
..  confval:: data
    :name: plotlychart.pieData
    :Type: mixed
    :required: true

    Data, or a reference to data 
     
..  confval:: layout
    :name: plotlychart.pieLayout
    :Type: mixed
    
    Layout, or a reference to layout    

..  confval:: config
    :name: plotlychart.pieConfig
    :Type: mixed
    
    Config, or a reference to config  
    
..  confval:: width
    :name: plotlychart.pieWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: plotlychart.pieHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Pie Chart
--------------------

..  code-block:: xml    

    <c:plotlycharts>
        <c:plotlychart.pie id="1" data="data__pieChartData" layout="data__pieChartLayout" >
            ...
        </c:plotlychart.pie>
    </c:plotlycharts>
    