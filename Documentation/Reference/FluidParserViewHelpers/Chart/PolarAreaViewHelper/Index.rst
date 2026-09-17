..  include:: ../../../../Includes.txt

..  _polarAreaViewHelper:

:navigation-title: chart.polarArea

========================================
PolarArea ViewHelper <c:chart.polarArea>
========================================

ViewHelper to include a polarArea chart with `Charts.js`.

Go to the source code of this ViewHelper: 
`PolarAreaViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/Chart/PolarAreaViewHelper.php>`_ (GitHub). 

Quick Test
==========

..  code-block:: xml 
    
    <c:template id="1">
    EXT:sav_charts/Resources/Private/Templates/ChartsExamples/FluidParser/PolarAreaChart.fluid"
    </c:template>

..  figure:: ../../../../Images/ScreenShots/Charts/polarAreaChart.png
    :width: 40% 

Arguments
=========

..  confval:: id
    :name: polarAreaId
    :Type: string
    :required: true
    
    Chart ID    

..  confval:: data
    :name: polarAreaData
    :Type: mixed
    :required: true

    Data, or a reference to data
    
..  confval:: options
    :name: polarAreaOptions
    :Type: mixed
    
    Options, or a reference to options    
    
..  confval:: width
    :name: polarAreaWidth
    :Type: string
    :Default: 600

    Width value, or a reference to the width value
        
..  confval:: height
    :name: polarAreaHeight
    :Type: string
    :Default: 400

    Height value, or a reference to the height value

Examples
========

Defining a PolarArea Chart
--------------------------

..  code-block:: xml    

    <c:charts>
        <c:chart.polarArea id="1" data="data__polarAreaChartData" options="data__polarAreaChartOptions" >
            ...
        </c:chart.polarArea>
    </c:charts>
    
