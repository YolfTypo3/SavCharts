.. include:: ../Includes.txt

.. _reference:

=========
Reference
=========

Starting with version 14.5.0, SAV Charts is provided with two template
parsers. 

..  card-grid::
    :columns: 1
    :columns-md: 2
    :gap: 4
    :class: pb-4
    :card-height: 100


    ..  card:: :ref:`XML Parser Reference <xmlParserReference>`

        XML parser is the historic parser developed for TYPO3 6.2. and later. 
        
        The general syntax for references is `tag#id`.

    ..  card:: :ref:`Fluid Parser Reference <fluidParserReference>`

        Fluid parser is the new parser based on Fluid syntax.
        
        The general syntax for references is `tag__id`. The value
        associated with the reference is obtained by the Fluid accessor 
        `{tag__id}`. 

..  toctree::
    :maxdepth: 5
    :titlesonly:
    :glob:
   
   XmlParserReference/Index
   FluidParserReference/Index 