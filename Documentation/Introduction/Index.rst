..  include:: ../Includes.txt

..  _introduction:

============
Introduction
============

What Does it Do?
================

This extension displays charts using the 
`Chart.js library <https://www.chartjs.org/>`_. 

SAV Charts was originally designed to build chart configurations through XML 
tags instead of JavaScript. Markers can be introduced in templates. Data can also 
be changed through XML either manually or using query managers.

Since version 14.6.0, data can also come from 
spreadsheets when using the Fluid parser, thanks 
to `PhpSpreadsheet<https://phpspreadsheet.readthedocs.io/en/latest/>`_.

..  important::

    Starting with version 14.5.0 of SAV Charts, a new parser based solely on 
    Fluid and specific viewHelpers has been introduced. 
    Thanks to Fluid syntax, it simplifies writing complex charts and using references.

    While generating charts is faster with the XML parser, writing complex code is much
    simpler with the Fluid parser.
    
.. toctree::
   :maxdepth: 1
   :titlesonly:
   :glob:

   ScreenShoots/Index
   Sponsoring/Index

        