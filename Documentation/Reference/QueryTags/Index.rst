.. include:: ../../Includes.txt

.. _queryTags:

==========
Query Tags
==========

.. only:: html

   .. contents::
      :depth: 1
      :local:  


.. _query.query:

query
=====

.. confval:: query

    ::
    
        <query id="myQueryId">...</query>
    
    :Type: Object
    :Description:
        Creates a query object.
    :Attributes:     
        - id (required): the identifier.      
    

.. _query.setQueryManager:

setQueryManager
===============

.. confval:: setQueryManager

    ::
    
        <setQueryManager name="savcharts" uid="queryUid" marker1="myMarker" ... />
    
    :Type: Object
    :Description:
        Defines the query manager associated with the query.
    :Attributes: 
        - name (required): Unless you have define you own query manager, use ``savcharts``.
        - uid (required): The uid of your query. Queries are defined in the backend.
        - other attributes define markers that can be used in the query clauses. In these clauses ###myMarker### will be
          replaced by the value of the marker ``myMarker``. Any attribute
          name, except ``name`` and ``uid`` can be used. 
    
          Markers can be directly defined as, for example, ``myMarker#myValue``.
          In that case, the marker name will be ``myMarker`` and its value is ``myValue``.      
                
          Markers can be defined as a reference to a marker tag, for example ``marker#myMarker``.
          In that case, the marker name will be ``myMarker`` and its value is the value of the marker
          whose id is ``myMarker``.
          
          Markers can also be defined as a reference to a specific element in a data or marker array, for example ``myMarker#data#myData:0``.
          In that case, the marker name will be ``myMarker`` and its value is obtained from the data with index ``0`` and whose id is ``myData`` .             

