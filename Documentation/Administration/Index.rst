.. include:: ../Includes.txt

.. _administration:

==============
Administration
==============

.. important::

   The flag ``Allow queries (Admin)`` must be set by an Admin user in the content 
   flexform to execute queries.
    
.. warning:: 

   This extension generates raw javacript codes from the chart configurations 
   in the backend.

   Most often, simple configurations are taken from the chart.js documentation. 
   However, more complex configurations can be entered. As said in the TYPO3 
   Security Guide, "*Even if editors do not insert malicious code intentionally,
   sometimes the lack of knowledge, expertise or security awareness could put 
   your website under risk*".

   Admin users should be careful before granting the rights for backend users 
   to enter charts.

TypoScript Constants and Setup
==============================

The extension comes with defaut TypoScript configurations for constants and setup.

.. code::
    
   plugin.tx_savcharts {
      view {
         # cat=plugin.tx_savcharts/file; type=string; label=Path to template root (FE)
         templateRootPath = EXT:sav_charts/Resources/Private/Templates/
         # cat=plugin.tx_savcharts/file; type=string; label=Path to template partials (FE)
         partialRootPath = EXT:sav_charts/Resources/Private/Partials/
         # cat=plugin.tx_savcharts/file; type=string; label=Path to template layouts (FE)
         layoutRootPath = EXT:sav_charts/Resources/Private/Layouts/
      }
      persistence {
         # cat=plugin.tx_savcharts//a; type=string; label=Default storage PID
         storagePid =
      }
   }  
    
.. code::
    
   plugin.tx_savcharts {
      view {
         templateRootPath = {$plugin.tx_savcharts.view.templateRootPath}
         partialRootPath = {$plugin.tx_savcharts.view.partialRootPath}
         layoutRootPath = {$plugin.tx_savcharts.view.layoutRootPath}
      }
      persistence {
         storagePid = {$plugin.tx_savcharts.persistence.storagePid}
      }
   }
    
Marker Tags From TypoScript 
===========================

Marker tags can be created from TypoScript and used in charts. In the following example
the marker ``MyMarker`` takes the value ``MyValue``.

.. code::

   plugin.tx_savcharts.settings.marker.myMarker = TEXT
   plugin.tx_savcharts.settings.marker.myMarker.value = MyValue   
   
Marker Replacement in Queries
=============================   
   
Marker replacement can also be performed in queries. The following 
example shows how to define the marker ``MyMarker`` associated 
with the query whose uid is equal to 1. The marker value ``MyValue`` 
will replace any marker ``###MyMarker###`` in the query clauses.

.. code::

   plugin.tx_savcharts.settings.customQuery = COA
   plugin.tx_savcharts.settings.customQuery.1.MyMarker = TEXT
   plugin.tx_savcharts.settings.customQuery.1.MyMarker.value = MyValue    