..  include:: ../../../../Includes.txt

..  _apexchart.funnelViewHelper:

:navigation-title: apexchart.funnel

======================================
Funnel ViewHelper <c:apexchart.funnel>
======================================

ViewHelper to include a funnel chart with `ApexCharts`.

Go to the source code of this ViewHelper: 
`FunnelViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/ApexChart/FunnelViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/ApexChartsExamples/FunnelChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ApexCharts/funnelChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: apexchart.funnelId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: apexchart.funnelOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: apexchart.funnelWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: apexchart.funnelHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Funnel Chart
-----------------------

..  code-block:: xml    

    <c:apexcharts>
        <c:apexchart.funnel id="1" options="data__funnelChartOptions" >
            ...
        </c:apexchart.funnel>
    </c:apexcharts>
    