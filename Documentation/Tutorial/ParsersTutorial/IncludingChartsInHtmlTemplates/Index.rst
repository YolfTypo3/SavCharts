..  include:: ../../../Includes.txt

..  _includingChartsInHtmlTemplates:

==================================
Including Charts in HTML Templates
==================================

SAV Charts viewHelpers can be used in any 
HTML template processed by Fluid.

The following example illustrates how to 
integrate a bar chart that displays
the number of pages created per year 
(see :ref:`usingAndDevelopingQueryManagers`).
        
..  code-block:: html
    
    {namespace c=YolfTypo3\SavCharts\ViewHelpers}
    <c:marker id="title">Analysis of the site</c:marker>
    <c:marker id="labelSet0">Pages per year</c:marker>
    <c:query id="1"  manager="savcharts" uid="1" />
    <c:data id="labels" values="{query__1.Year}" />
    <c:data id="data">
      <c:item key="0" value="{query__1.Count}" />
    </c:data>
    <c:template id="1">
        EXT:sav_charts/Resources/Private/Templates/ChartsExamples/FluidParser/BarChartAdvanced.fluid
    </c:template>
    
    <canvas id="canvas{canvases.0.chartId}" width="{canvases.0.width}" height="{canvases.0.height}"></canvas>

..  note::
    
    The Fluid variable `canvases` contains information
    on the created charts, starting from 0. Therefore,
    `canvases.0.chartId` is the ID of the first chart
    in `EXT:sav_charts/Resources/Private/Templates/ChartsExamples/FluidParser/BarChartAdvanced.fluid`.                