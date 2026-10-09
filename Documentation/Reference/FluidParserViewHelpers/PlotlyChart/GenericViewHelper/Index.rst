..  include:: ../../../../Includes.txt

..  _plotlychart.genericViewHelper:

:navigation-title: plotlychart.generic

==========================================
Generic ViewHelper <c:plotlychart.generic>
==========================================

ViewHelper to include a generic chart, that is a
chart that has no predefined type, with `Plotly`.

Go to the source code of this ViewHelper: 
`GenericViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/PlotlyChart/GenericViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/PlotlyChartsExamples/GroupedBarChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/PlotlyCharts/groupedBarChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: plotlychart.genericId
    :Type: string
    :required: true
    
    Chart ID    

..  confval:: data
    :name: plotlychart.genericData
    :Type: mixed
    :required: true

    Data, or a reference to data 
    
..  confval:: layout
    :name: plotlychart.genericLayout
    :Type: mixed
    
    Layout, or a reference to layout    

..  confval:: config
    :name: plotlychart.genericConfig
    :Type: mixed
    
    Config, or a reference to config 
        
..  confval:: width
    :name: plotlychart.genericWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: plotlychart.genericHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Generic Chart
------------------------

..  code-block:: xml    

    <c:plotlycharts>
        <c:plotlychart.generic id="1" data="data__genericChartData" layout="data__genericChartLayout" >
            ...
        </c:plotlychart.generic>
    </c:plotlycharts>
    