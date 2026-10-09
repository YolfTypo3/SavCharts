..  include:: ../../../../Includes.txt

..  _plotlychart.funnelViewHelper:

:navigation-title: plotlychart.funnel

========================================
Funnel ViewHelper <c:plotlychart.funnel>
========================================

ViewHelper to include a funnel chart with `Plotly`.

Go to the source code of this ViewHelper: 
`FunnelViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/PlotlyChart/FunnelViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/PlotlyChartsExamples/FunnelChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/PlotlyCharts/funnelChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: plotlychart.funnelId
    :Type: string
    :required: true
    
    Chart ID    

..  confval:: data
    :name: plotlychart.funnelData
    :Type: mixed
    :required: true

    Data, or a reference to data 
        
..  confval:: layout
    :name: plotlychart.funnelLayout
    :Type: mixed
    
    Layout, or a reference to layout    

..  confval:: config
    :name: plotlychart.funnelConfig
    :Type: mixed
    
    Config, or a reference to config  
        
..  confval:: width
    :name: plotlychart.funnelWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: plotlychart.funnelHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Funnel Chart
-----------------------

..  code-block:: xml    

    <c:plotlycharts>
        <c:plotlychart.funnel id="1" data="data__funnelChartData" layout="data__funnelChartLayout" >
            ...
        </c:plotlychart.funnel>
    </c:plotlycharts>
    