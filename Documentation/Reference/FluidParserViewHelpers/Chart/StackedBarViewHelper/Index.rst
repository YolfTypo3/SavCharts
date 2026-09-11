..  include:: ../../../../Includes.txt

..  _stackedBarViewHelper:

:navigation-title: chart.stackedBar

=======================================================
StackedBar ViewHelper <c:chart.stackedBar>
=======================================================

ViewHelper to include a stackedBar chart.

Go to the source code of this ViewHelper: 
`StackedBarViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/Chart/StackedBarViewHelper.php>`_ (GitHub). 

Arguments
=========

..  confval:: id
    :name: stackedBarId
    :Type: string
    :required: true
    
    Chart ID    

..  confval:: data
    :name: stackedBarData
    :Type: mixed
    :required: true

    Data, or a reference to data
    
..  confval:: options
    :name: stackedBarOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: stackedBarWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: stackedBarHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value



Examples
========

Defining a stackedBar Chart
---------------------------

..  code-block:: xml    

    <c:charts>
        <c:chart.stackedBar id="1" data="data__stackedBarChartData" options="data__stackedBarChartOptions" >
            ...
        </c:chart.stackedBar>
    </c:charts>
    
