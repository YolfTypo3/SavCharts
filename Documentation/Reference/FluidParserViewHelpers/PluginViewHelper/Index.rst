..    include:: ../../../Includes.txt

..    _pluginViewHelper:

:navigation-title: plugin

==================================
Template ViewHelper `<c:plugin>`
==================================

ViewHelper that includes a plugin.

Go to the source code of this ViewHelper: 
`PluginViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/PluginViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the plugin ViewHelper: 

..  confval:: chartId
    :name: pluginChartId
    :Type: string
    :required: true
        
..  confval:: key
    :name: pluginKey
    :Type: string
    :required: true    
    
    Plugin key

..  confval:: fileName
    :name: pluginFileName
    :Type: string
    :default: '' 
    
    File name containing the JavaScript function
    
Examples
========

The following examples should be included in the 
"Templates" field of the "Fluid Parser" tab 
of the plugin. 

With fileName attribute
-----------------------

..  code-block:: xml    
    
    <c:plugin chartId="pie__1" key="chartAreaBorder" fileName="EXT:sav_charts/Resources/Public/Plugins/ChartAreaBorder.js" />

Child nodes
-----------

The JavaScript function is directly inserted in the child.

..  code-block:: xml    

    <c:plugin chartId="pie__1" key="chartAreaBorder">
        beforeDraw(chart, args, options) {
            const { 
                ctx, 
                chartArea: { left, top, width, height } 
            } = chart;
        
            ctx.save();
            ctx.strokeStyle = options.borderColor;
            ctx.lineWidth = options.borderWidth;
            ctx.setLineDash(options.borderDash || []);
            ctx.lineDashOffset = options.borderDashOffset;
            ctx.strokeRect(left, top, width, height);
            ctx.restore();
        }
    </c:plugin>
    
