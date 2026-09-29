..  include:: ../../../../Includes.txt

..  _apexchart.genericViewHelper:

:navigation-title: apexchart.generic

========================================
Scatter ViewHelper <c:apexchart.generic>
========================================

ViewHelper to include a generic chart, that is a
chart that has no predefined type, with `ApexCharts`.

Go to the source code of this ViewHelper: 
`GenericViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/ApexChart/GenericViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/ApexChartsExamples/StackedBarChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ApexCharts/stackedBarChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: apexchart.genericId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: apexchart.genericOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: apexchart.genericWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: apexchart.genericHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Generic Chart
------------------------

..  code-block:: xml    

    <c:apexcharts>
        <c:apexchart.generic id="1" options="data__genericChartOptions" >
            ...
        </c:apexchart.generic>
    </c:apexcharts>
    