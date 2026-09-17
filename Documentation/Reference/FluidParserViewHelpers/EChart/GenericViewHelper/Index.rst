..  include:: ../../../../Includes.txt

..  _echart.genericViewHelper:

:navigation-title: echart.generic

=====================================
Scatter ViewHelper <c:echart.generic>
=====================================

ViewHelper to include a generic chart, that is a
chart that has no predefined type, with `Apache ECharts`.

Go to the source code of this ViewHelper: 
`GenericViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/EChart/GenericViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/EChartsExamples/StackedBarChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ECharts/stackedBarChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: echart.genericId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: echart.genericOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: echart.genericWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: echart.genericHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Generic Chart
------------------------

..  code-block:: xml    

    <c:echarts>
        <c:echart.generic id="1" options="data__genericChartOptions" >
            ...
        </c:echart.generic>
    </c:echarts>
    