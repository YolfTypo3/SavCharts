..  include:: ../Includes.txt

..  _introduction:

============
Introduction
============

What Does it Do?
================

This extension displays charts using the 
`Chart.js<https://www.chartjs.org/>`_,
`Apache ECharts<https://echarts.apache.org/>`_,
`ApexCharts<https://apexcharts.com/>`_, or
`Plotly <https://plotly.com/javascript/>`_
libraries. 

Charts are defined using templates that 
allow elements to be modified dynamically. 
Therefore, charts can contain data entered 
directly into templates or 
obtained from queries or spreadsheets.

Many examples are provided to help you use 
SAV Charts (see :ref:`screnshoots <screenshoots>`).


SAV Charts History
==================

SAV Charts was originally designed to build 
charts using the Chart.js library and configurations 
through XML tags instead of JavaScript. 

Markers were introduced to allow the template 
behaviors to be easily modified. Data could 
also be modified through XML tags, either 
manually or using query managers.

The XML Parser was developed
for TYPO3 6.2 and later versions. Based mainly 
on the PHP class SimpleXMLElement, it enables 
fast chart generation.  Only a few changes
were made until version 14.3.0 of TYPO3.
However, the PHP code is
complex. XML templates lack readability when 
iterative processing is required.

Starting with version 14.5.0 of SAV Charts, a new parser based solely on 
Fluid and specific viewHelpers has been introduced. 
Thanks to the Fluid syntax, creating complex charts and using references
has become easier.

Since all Fluid viewHelpers
can be used (e.g. <f:for>, <f:if>, and <f:variable>)
the Fluid Parser results in simpler templates when
iterative processing is required. It also provides 
simpler PHP code and makes it possible to use or
develop other viewHelpers. 

Thus, viewHelpers for retrieving data from 
spreadsheets were introduced in version 14.6.0 of SAV Charts, thanks 
to `PhpSpreadsheet<https://phpspreadsheet.readthedocs.io/en/latest/>`_.

ViewHelpers for the Apache ECharts library were introduced
in version 14.7.0.

Those for the  ApexCharts library
were introduced in version 14.8.0.

Finaly, those for the Plotly library were introduced in 
version 14.9.0 of SAV Charts. A JavaScript to 
Fluid Parser converter was introduced to 
facilitate testing the available examples on
`Chart.js<https://www.chartjs.org/>`_,
`Apache ECharts<https://echarts.apache.org/>`_,
`ApexCharts<https://apexcharts.com/>`_, or
`Plotly <https://plotly.com/javascript/>`_.

..  note::
    The XML Parser is maintained for compatibility
    and may be removed in the future.


Table of Contents
=================
    
..  toctree::
    :maxdepth: 1
    :titlesonly:
    :glob:

    Screenshoots/Index
    Sponsoring/Index

        