..  include:: ../../../../Includes.txt

..  _bubbleViewHelper:

:navigation-title: chart.bubble

===============================
Bar ViewHelper <c:chart.bubble>
===============================

ViewHelper to include a bubble chart.

Go to the source code of this ViewHelper: 
`BubbleViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/Chart/BubbleViewHelper.php>`_ (GitHub). 

Arguments
=========

..  confval:: id
    :name: bubbleId
    :Type: string
    :required: true
    
    Chart ID    

..  confval:: data
    :name: bubbleData
    :Type: mixed
    :required: true

    Data, or a reference to data
    
..  confval:: options
    :name: bubbleOptions
    :Type: mixed
    :required: true
    
    Options, or a reference to options    
    
..  confval:: width
    :name: bubbleWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: bubbleHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value



Examples
========

Defining a Bubble Chart
-----------------------

..  code-block:: xml    

    <c:charts>
        <c:chart.bubble id="1" data="data__bubbleChartData" options="data__bubbleChartOptions" >
            ...
        </c:chart.bubble>
    </c:charts>
    
