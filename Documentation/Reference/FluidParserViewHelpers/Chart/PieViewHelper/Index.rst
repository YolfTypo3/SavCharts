..  include:: ../../../../Includes.txt

..  _pieViewHelper:

:navigation-title: chart.pie

============================
Pie ViewHelper <c:chart.pie>
============================

ViewHelper to include a pie chart.

Go to the source code of this ViewHelper: 
`PieViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/Chart/PieViewHelper.php>`_ (GitHub). 

Arguments
=========

..  confval:: id
    :name: pieId
    :Type: string
    :required: true
    
    Chart ID    

..  confval:: data
    :name: pieData
    :Type: mixed
    :required: true

    Data, or a reference to data
    
..  confval:: options
    :name: pieOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: pieWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: pieHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Pie Chart
--------------------

..  code-block:: xml    

    <c:charts>
        <c:chart.pie id="1" data="data__pieChartData" options="data__pieChartOptions" >
            ...
        </c:chart.pie>
    </c:charts>
    
