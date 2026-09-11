..  include:: ../../../../Includes.txt

..  _horizontalBarViewHelper:

:navigation-title: chart.horizontalBar

================================================
HorizontalBar ViewHelper <c:chart.horizontalBar>
================================================

ViewHelper to include a horizontalBar chart.

Go to the source code of this ViewHelper: 
`HorizontalBarViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/Chart/HorizontalBarViewHelper.php>`_ (GitHub). 

Arguments
=========

..  confval:: id
    :name: horizontalBarId
    :Type: string
    :required: true
    
    Chart ID    

..  confval:: data
    :name: horizontalBarData
    :Type: mixed
    :required: true

    Data, or a reference to data
    
..  confval:: options
    :name: horizontalBarOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: horizontalBarWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: horizontalBarHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value



Examples
========

Defining a horizontalBar Chart
------------------------------

..  code-block:: xml    

    <c:charts>
        <c:chart.horizontalBar id="1" data="data__horizontalBarChartData" options="data__horizontalBarChartOptions" >
            ...
        </c:chart.horizontalBar>
    </c:charts>
    
