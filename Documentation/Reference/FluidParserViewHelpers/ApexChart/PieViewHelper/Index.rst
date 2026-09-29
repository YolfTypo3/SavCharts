..  include:: ../../../../Includes.txt

..  _apexchart.pieViewHelper:

:navigation-title: apexchart.pie

================================
Pie ViewHelper <c:apexchart.pie>
================================

ViewHelper to include a pie chart with `ApexCharts`.

Go to the source code of this ViewHelper: 
`PieViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/ApexChart/PieViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/ApexChartsExamples/PieChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/ApexCharts/pieChart.png
    :width: 40%  

Arguments
=========

..  confval:: id
    :name: apexchart.pieId
    :Type: string
    :required: true
    
    Chart ID    
    
..  confval:: options
    :name: apexchart.pieOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: apexchart.pieWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: apexchart.pieHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Pie Chart
--------------------

..  code-block:: xml    

    <c:apexcharts>
        <c:apexchart.pie id="1" options="data__pieChartOptions" >
            ...
        </c:apexchart.pie>
    </c:apexcharts>
    