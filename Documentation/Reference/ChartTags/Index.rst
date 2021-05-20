.. include:: ../../Includes.txt

.. _chartTags:

==========
Chart Tags
==========

====================================== ================ =================================================
Tag                                    Data type        Description                 
====================================== ================ =================================================
:ref:`chart.charts`                    Root object      Creates a charts root object.
:ref:`chart.addItem`                   Root method      Adds an item to an array.
:ref:`chart.exportCsv`                 Root method      Exports data in CSV format.
:ref:`chart.setid`                     Root method      Sets a new id to an element.
:ref:`chart.barChart`                  Object           Creates a bar chart object.
:ref:`chart.barChart`                  Object           Creates a bubble chart object.
:ref:`chart.doughnutChart`             Object           Creates a doughnut chart object.
:ref:`chart.horizontalBarChart`        Object           Creates an horizontal bar chart object.
:ref:`chart.horizontalStackedBarChart` Object           Creates an horizontal stacked bar chart object.
:ref:`chart.lineChart`                 Object           Creates a line chart object.
:ref:`chart.pieChart`                  Object           Creates a pie chart object.
:ref:`chart.polarAreaChart`            Object           Creates a polar area chart object.
:ref:`chart.radarChart`                Object           Creates a radar chart object.
:ref:`chart.scatterChart`              Object           Creates a scatter chart object.
:ref:`chart.stackedBarChart`           Object           Creates a stacked bar chart object.
====================================== ================ =================================================

.. _chart.charts:

charts
======

.. container:: table-row

  Property
    <charts>...</charts>
    
  Data type
    Object
    
  Description
    Creates a charts object. The tag <charts> is the root xml element.


.. _chart.addItem:
    
addItem
=======

.. container:: table-row

  Property
    <addItem reference="object#id" key="myKey" value="myValue" />
    
  Data type
    Root method
    
  Description
    Method associated with the root tag <charts> which adds an item in an array.
    
    Attributes:
    
    - reference (required): the object reference.    
    - key (required): the key of the item in the array.              
    - value(required): the value associated with the item.        
     
     
.. _chart.exportCsv:
    
exportCsv
=========

.. container:: table-row

  Property
    <exportCvs reference="object#id" data="object#id" />
    
  Data type
    Root method
    
  Description
    Method associated with the root tag <charts> which makes it possible to export data in the CSV format.
    
    Attributes:
    
    - reference (required): the object reference.    
    - data (required): the reference to data.              
    - rowHeader: if set, the reference to the row header.  
    - columnHeader: if set, the reference to the column header.    
    - encoding: if set, the encoding is used to convert the output. By default, the CSV output is converted to ISO-8859-1.      
     
     
.. _chart.setId:
    
setId
=====

.. container:: table-row

  Property
    <setId reference="object#id" newId="myNewId" />
    
  Data type
    Root method
    
  Description
    Method associated with the root tag <charts> which makes it possible to change the id of the object given in the reference attribute.
    
    Attributes:
    
    - reference (required): the object reference.    
    - newId (required): the new id.              
                     

.. _chart.barChart:

barChart
========

.. container:: table-row

  Property
    <barChart id="myBarChartId" data="data#myBarChartData">...</barChart>
    
  Data type
    Object
    
  Description
    Creates a bar chart object.
    
    Attributes:
    
    - id (required): the identifier. 
    - data (required): a reference to the data used for the chart (in general a reference to a data object).
    - options: a reference to the options (in general a reference to a data object).  
    - width: the canvas width. If this attribute is not provided, the default width is 400.
    - height: the canvas height. If this attribute is not provided, the default height is 300.


.. _chart.bubbleChart:

bubbleChart
===========

.. container:: table-row

  Property
    <bubbleChart id="myBubbleChartId" data="data#myBubbleChartData">...</bubbleChart>
    
  Data type
    Object
    
  Description
    Creates a buble chart object.
    
    Attributes:
    
    - id (required): the identifier. 
    - data (required): a reference to the data used for the chart (in general a reference to a data object).
    - options: a reference to the options (in general a reference to a data object).  
    - width: the canvas width. If this attribute is not provided, the default width is 400.
    - height: the canvas height. If this attribute is not provided, the default height is 300.

      
.. _chart.doughnutChart:

doughnutChart
=============

.. container:: table-row

  Property
    <doughnutChart id="myDoughnutChartId" data="data#myDoughnutChartData">...</doughnutChart>
    
  Data type
    Object
    
  Description
    Creates a doughnut chart object.
    
    Attributes:
    
    - id (required): the identifier. 
    - data (required): a reference to the data used for the chart (in general a reference to a data object).
    - options: a reference to the options (in general a reference to a data object).  
    - width: the canvas width. If this attribute is not provided, the default width is 400.
    - height: the canvas height. If this attribute is not provided, the default height is 300.


.. _chart.horizontalBarChart:


horizontalBarChart
==================

.. container:: table-row

  Property
    <horizontalBarChart id="myhorizontalBarChartId" data="data#myhorizontalBarChartData">...</horizontalBarChart>
    
  Data type
    Object
    
  Description
    Creates an horizontal bar chart object.
    
    Attributes:
    
    - id (required): the identifier. 
    - data (required): a reference to the data used for the chart (in general a reference to a data object).
    - options: a reference to the options (in general a reference to a data object).  
    - width: the canvas width. If this attribute is not provided, the default width is 400.
    - height: the canvas height. If this attribute is not provided, the default height is 300.



.. _chart.horizontalStackedBarChart:


horizontalStackedBarChart
=========================

.. container:: table-row

  Property
    <horizontalStackedBarChart id="myhorizontalStackedBarChartId" data="data#myhorizontalStackedBarChartData">...</horizontalStackedBarChart>
    
  Data type
    Object
    
  Description
    Creates an horizontal stacked bar chart object.
    
    Attributes:
    
    - id (required): the identifier. 
    - data (required): a reference to the data used for the chart (in general a reference to a data object).
    - options: a reference to the options (in general a reference to a data object).  
    - width: the canvas width. If this attribute is not provided, the default width is 400.
    - height: the canvas height. If this attribute is not provided, the default height is 300.
 
 
      
.. _chart.lineChart:

lineChart
=========

.. container:: table-row

  Property
    <lineChart id="myLineChartId" data="data#myLineChartData">...</lineChart>
    
  Data type
    Object
    
  Description
    Creates a doughnut chart object.
    
    Attributes:
    
    - id (required): the identifier. 
    - data (required): a reference to the data used for the chart (in general a reference to a data object).
    - options: a reference to the options (in general a reference to a data object).  
    - width: the canvas width. If this attribute is not provided, the default width is 400.
    - height: the canvas height. If this attribute is not provided, the default height is 300.


      
.. _chart.pieChart:

pieChart
========

.. container:: table-row

  Property
    <pieChart id="myPieChartId" data="data#myPieChartData">...</pieChart>
    
  Data type
    Object
    
  Description
    Creates a pie chart object.
    
    Attributes:
    
    - id (required): the identifier. 
    - data (required): a reference to the data used for the chart (in general a reference to a data object).
    - options: a reference to the options (in general a reference to a data object).  
    - width: the canvas width. If this attribute is not provided, the default width is 400.
    - height: the canvas height. If this attribute is not provided, the default height is 300.


      
.. _chart.polarAreaChart:

polarAreaChart
==============

.. container:: table-row

  Property
    <polarAreaChart id="myPolarAreaChartId" data="data#myPolarAreaChartData">...</polarAreaChart>
    
  Data type
    Object
    
  Description
    Creates a polar Area chart object.
    
    Attributes:
    
    - id (required): the identifier. 
    - data (required): a reference to the data used for the chart (in general a reference to a data object).
    - options: a reference to the options (in general a reference to a data object).  
    - width: the canvas width. If this attribute is not provided, the default width is 400.
    - height: the canvas height. If this attribute is not provided, the default height is 300.


      
.. _chart.radarChart:

radarChart
==========

.. container:: table-row

  Property
    <radarChart id="myRadarChartId" data="data#myRadarChartData">...</radarChart>
    
  Data type
    Object
    
  Description
    Creates a radar chart object.
    
    Attributes:
    
    - id (required): the identifier. 
    - data (required): a reference to the data used for the chart (in general a reference to a data object).
    - options: a reference to the options (in general a reference to a data object).  
    - width: the canvas width. If this attribute is not provided, the default width is 400.
    - height: the canvas height. If this attribute is not provided, the default height is 300.



.. _chart.scatterChart:

scatterChart
============

.. container:: table-row

  Property
    <scatterChart id="myScatterChartId" data="data#myScatterChartData">...</radarChart>
    
  Data type
    Object
    
  Description
    Creates a scatter chart object.
    
    Attributes:
    
    - id (required): the identifier. 
    - data (required): a reference to the data used for the chart (in general a reference to a data object).
    - options: a reference to the options (in general a reference to a data object).  
    - width: the canvas width. If this attribute is not provided, the default width is 400.
    - height: the canvas height. If this attribute is not provided, the default height is 300.


      
.. _chart.stackedBarChart:

stackedBarChart
===============

.. container:: table-row

  Property
    <stackedBarChart id="myStackedBarChartId" data="data#myStackedBarChartData">...</stackedBarChart>
    
  Data type
    Object
    
  Description
    Creates a stacked bar chart object.
    
    Attributes:
    
    - id (required): the identifier. 
    - data (required): a reference to the data used for the chart (in general a reference to a data object).
    - options: a reference to the options (in general a reference to a data object).  
    - width: the canvas width. If this attribute is not provided, the default width is 400.
    - height: the canvas height. If this attribute is not provided, the default height is 300.
    
    
       