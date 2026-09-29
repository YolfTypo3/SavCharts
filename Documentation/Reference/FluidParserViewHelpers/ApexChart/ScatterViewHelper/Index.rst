..  include:: ../../../../Includes.txt

..  _apexchart.scatterViewHelper:

:navigation-title: apexchart.scatter

========================================
Scatter ViewHelper <c:apexchart.scatter>
========================================

ViewHelper to include a scatter chart with `ApexCharts`.

Go to the source code of this ViewHelper: 
`ScatterViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/ApexChart/ScatterViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/ApexChartsExamples/ScatterChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ApexCharts/scatterChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: apexchart.scatterId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: apexchart.scatterOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: apexchart.scatterWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: apexchart.scatterHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Scatter Chart
------------------------

..  code-block:: xml    

    <c:apexcharts>
        <c:apexchart.scatter id="1" options="data__scatterChartOptions" >
            ...
        </c:apexchart.scatter>
    </c:apexcharts>
