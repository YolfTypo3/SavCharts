..  include:: ../../../../Includes.txt

..  _scatterViewHelper:

:navigation-title: chart.scatter

====================================
Scatter ViewHelper <c:chart.scatter>
====================================

ViewHelper to include a scatter chart.

Go to the source code of this ViewHelper: 
`ScatterViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/Chart/ScatterViewHelper.php>`_ (GitHub). 

Arguments
=========

..  confval:: id
    :name: scatterId
    :Type: string
    :required: true
    
    Chart ID    

..  confval:: data
    :name: scatterData
    :Type: mixed
    :required: true

    Data, or a reference to data
    
..  confval:: options
    :name: scatterOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: scatterWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: scatterHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a Scatter Chart
------------------------

..  code-block:: xml    

    <c:charts>
        <c:chart.scatter id="1" data="data__scatterChartData" options="data__scatterChartOptions" >
            ...
        </c:chart.scatter>
    </c:charts>
    
