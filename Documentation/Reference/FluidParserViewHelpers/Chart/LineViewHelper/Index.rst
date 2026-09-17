..  include:: ../../../../Includes.txt

..  _lineViewHelper:

:navigation-title: chart.line

=============================
Pie ViewHelper <c:chart.line>
=============================

ViewHelper to include a line chart with `Charts.js`.

Go to the source code of this ViewHelper: 
`LineViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/Chart/LineViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/ChartsExamples/FluidParser/LineChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/Charts/lineChart.png
    :width: 40% 
    
Arguments
=========

..  confval:: id
    :name: lineId
    :Type: string
    :required: true
    
    Chart ID    

..  confval:: data
    :name: lineData
    :Type: mixed
    :required: true

    Data, or a reference to data
    
..  confval:: options
    :name: lineOptions
    :Type: mixed
    
    Options, or a reference to options    
    
..  confval:: width
    :name: lineWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: lineHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Line Chart
--------------------

..  code-block:: xml    

    <c:charts>
        <c:chart.line id="1" data="data__lineChartData" options="data__lineChartOptions" >
            ...
        </c:chart.line>
    </c:charts>
    