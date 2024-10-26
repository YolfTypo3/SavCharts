.. include:: ../../Includes.txt

.. _chartTags:

==========
Chart Tags
==========

.. only:: html

   .. contents::
      :depth: 1
      :local:
      
.. _chart.charts:

charts
======

.. confval:: charts

    ::
    
        <charts>...</charts>
        
    :Type: Root object
    :Description: 
        Creates a charts object. The tag <charts> is the root xml element.


.. _chart.addItem:
    
addItem
=======

.. confval:: addItem
 
    ::
    
        <addItem reference="object#id" key="myKey" value="myValue" />
            
    :Type: Root method
    :Description: 
        Method associated with the root tag <charts> which adds an item in an array.
    :Attributes:  
        - reference (required): the object reference.    
        - key (required): the key of the item in the array.              
        - value(required): the value associated with the item.        
     
     
.. _chart.exportCsv:
    
exportCsv
=========

.. confval:: exportCsv
 
    ::
    
        <exportCvs reference="object#id" data="object#id" />

    :Type: Root method
    :Description:     
        Method associated with the root tag <charts> which makes it possible to export data in the CSV format.
    :Attributes:    
        - reference (required): the object reference.    
        - data (required): the reference to data.              
        - rowHeader: if set, the reference to the row header.  
        - columnHeader: if set, the reference to the column header.    
        - encoding: if set, the encoding is used to convert the output. By default, the CSV output is converted to ISO-8859-1.      
         
     
.. _chart.setId:
    
setId
=====

.. confval:: setId

    ::
    
        <setId reference="object#id" newId="myNewId" />
    
    :Type: Root method
    :Description:
        Method associated with the root tag <charts> which makes it possible to change the id of the object given in the reference attribute.
    :Attributes:
        - reference (required): the object reference.    
        - newId (required): the new id.              
                     

.. _chart.barChart:

barChart
========

.. confval:: barChart
 
    ::
    
        <barChart id="myBarChartId" data="data#myBarChartData">...</barChart>

    :Type: Object
    :Description:
        Creates a bar chart object.
    :Attributes:  
        - id (required): the identifier. 
        - data (required): a reference to the data used for the chart (in general a reference to a data object).
        - options: a reference to the options (in general a reference to a data object).  
        - width: the canvas width. If this attribute is not provided, the default width is 400.
        - height: the canvas height. If this attribute is not provided, the default height is 300.


.. _chart.bubbleChart:

bubbleChart
===========

.. confval:: bubbleChart
 
    ::
    
        <bubbleChart id="myBubbleChartId" data="data#myBubbleChartData">...</bubbleChart>
    
    :Type: Object
    :Description:
        Creates a buble chart object.
    :Attributes: 
        - id (required): the identifier. 
        - data (required): a reference to the data used for the chart (in general a reference to a data object).
        - options: a reference to the options (in general a reference to a data object).  
        - width: the canvas width. If this attribute is not provided, the default width is 400.
        - height: the canvas height. If this attribute is not provided, the default height is 300.

      
.. _chart.doughnutChart:

doughnutChart
=============

.. confval:: doughnutChart
 
    ::
    
        <doughnutChart id="myDoughnutChartId" data="data#myDoughnutChartData">...</doughnutChart>
    
    :Type: Object
    :Description:
        Creates a doughnut chart object.
    :Attributes:   
        - id (required): the identifier. 
        - data (required): a reference to the data used for the chart (in general a reference to a data object).
        - options: a reference to the options (in general a reference to a data object).  
        - width: the canvas width. If this attribute is not provided, the default width is 400.
        - height: the canvas height. If this attribute is not provided, the default height is 300.


.. _chart.horizontalBarChart:


horizontalBarChart
==================

.. confval:: horizontalBarChart
 
    ::

        <horizontalBarChart id="myhorizontalBarChartId" data="data#myhorizontalBarChartData">...</horizontalBarChart>
    
    :Type: Object
    :Description:
        Creates an horizontal bar chart object.
    :Attributes:
        - id (required): the identifier. 
        - data (required): a reference to the data used for the chart (in general a reference to a data object).
        - options: a reference to the options (in general a reference to a data object).  
        - width: the canvas width. If this attribute is not provided, the default width is 400.
        - height: the canvas height. If this attribute is not provided, the default height is 300.


.. _chart.horizontalStackedBarChart:

horizontalStackedBarChart
=========================

.. confval:: horizontalStackedBarChart
 
    ::

        <horizontalStackedBarChart id="myhorizontalStackedBarChartId" data="data#myhorizontalStackedBarChartData">...</horizontalStackedBarChart>
    
    :Type: Object
    :Description:
        Creates an horizontal stacked bar chart object.
    :Attributes:  
        - id (required): the identifier. 
        - data (required): a reference to the data used for the chart (in general a reference to a data object).
        - options: a reference to the options (in general a reference to a data object).  
        - width: the canvas width. If this attribute is not provided, the default width is 400.
        - height: the canvas height. If this attribute is not provided, the default height is 300.
 
  
.. _chart.lineChart:

lineChart
=========

.. confval:: lineChart
 
    ::

        <lineChart id="myLineChartId" data="data#myLineChartData">...</lineChart>
    
    :Type: Object
    :Description:
        Creates a doughnut chart object. 
    :Attributes:
        - id (required): the identifier. 
        - data (required): a reference to the data used for the chart (in general a reference to a data object).
        - options: a reference to the options (in general a reference to a data object).  
        - width: the canvas width. If this attribute is not provided, the default width is 400.
        - height: the canvas height. If this attribute is not provided, the default height is 300.

      
.. _chart.pieChart:

pieChart
========

.. confval:: pieChart
 
    ::

        <pieChart id="myPieChartId" data="data#myPieChartData">...</pieChart>
    
    :Type: Object  
    :Description:
        Creates a pie chart object.
    :Attributes:    
        - id (required): the identifier. 
        - data (required): a reference to the data used for the chart (in general a reference to a data object).
        - options: a reference to the options (in general a reference to a data object).  
        - width: the canvas width. If this attribute is not provided, the default width is 400.
        - height: the canvas height. If this attribute is not provided, the default height is 300.

  
.. _chart.polarAreaChart:

polarAreaChart
==============

.. confval:: polarAreaChart
 
    ::
    
        <polarAreaChart id="myPolarAreaChartId" data="data#myPolarAreaChartData">...</polarAreaChart>
    
    :Type: Object
    :Description:
        Creates a polar Area chart object. 
    :Attributes: 
        - id (required): the identifier. 
        - data (required): a reference to the data used for the chart (in general a reference to a data object).
        - options: a reference to the options (in general a reference to a data object).  
        - width: the canvas width. If this attribute is not provided, the default width is 400.
        - height: the canvas height. If this attribute is not provided, the default height is 300.

      
.. _chart.radarChart:

radarChart
==========

.. confval:: radarChart
 
    ::
    
        <radarChart id="myRadarChartId" data="data#myRadarChartData">...</radarChart>
    
    :Type: Object
    :Description:
        Creates a radar chart object. 
    :Attributes:   
        - id (required): the identifier. 
        - data (required): a reference to the data used for the chart (in general a reference to a data object).
        - options: a reference to the options (in general a reference to a data object).  
        - width: the canvas width. If this attribute is not provided, the default width is 400.
        - height: the canvas height. If this attribute is not provided, the default height is 300.


.. _chart.scatterChart:

scatterChart
============

.. confval:: scatterChart
 
    ::
    
        <scatterChart id="myScatterChartId" data="data#myScatterChartData">...</radarChart>
    
    :Type: Object
    :Description:
        Creates a scatter chart object.
    :Attributes: 
        - id (required): the identifier. 
        - data (required): a reference to the data used for the chart (in general a reference to a data object).
        - options: a reference to the options (in general a reference to a data object).  
        - width: the canvas width. If this attribute is not provided, the default width is 400.
        - height: the canvas height. If this attribute is not provided, the default height is 300.


      
.. _chart.stackedBarChart:

stackedBarChart
===============

.. confval:: stackedBarChart
 
    ::
    
        <stackedBarChart id="myStackedBarChartId" data="data#myStackedBarChartData">...</stackedBarChart>
    
    :Type: Object
    :Description:
        Creates a stacked bar chart object.
    :Attributes:   
        - id (required): the identifier. 
        - data (required): a reference to the data used for the chart (in general a reference to a data object).
        - options: a reference to the options (in general a reference to a data object).  
        - width: the canvas width. If this attribute is not provided, the default width is 400.
        - height: the canvas height. If this attribute is not provided, the default height is 300.
    
    
       