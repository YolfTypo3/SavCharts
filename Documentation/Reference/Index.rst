.. include:: ../Includes.txt

.. _reference:

=========
Reference
=========

Starting with version 14.5.0, SAV Charts comes with two template
parsers: a Fluid Parser and an XML Parser. 

..  card-grid::
    :columns: 1
    :columns-md: 2
    :gap: 4
    :class: pb-4
    :card-height: 100

    ..  card:: :ref:`Fluid ViewHelpers <fluidParserViewHelpers>`

        Fluid Parser is the new parser based on Fluid syntax.
        
        The general syntax for references is `tag__id`. The value
        associated with the reference is obtained by the Fluid accessor 
        `{tag__id}`. 
        
    ..  card:: :ref:`XML Tags <xmlParserTags>`

        XML Parser is the historic parser developed for TYPO3 6.2. and later. 
        
        The general syntax for references is `tag#id`.


Table of Contents
=================

..  toctree::
    :maxdepth: 5
    :titlesonly:
    :glob:
   
    FluidParserViewHelpers/Index
    XmlParserTags/Index 