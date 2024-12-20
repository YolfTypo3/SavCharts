.. include:: ../../Includes.txt

.. _markerTags:

===========
Marker Tags
===========

.. only:: html

   .. contents::
      :depth: 1
      :local: 

.. _marker.marker:

marker
======

.. confval:: marker

    ::
    
        <marker id="myMarkerId">marker value</marker>
    
    :Type: Object
    :Description:
        Creates a marker object
    :Attributes:
        - id (required): the identifier.  
            
        It is equivalent to:
    
        .. code::
    
            <marker id="myMarkerId">
               <setMarker value="marker value"/>
            </template>

.. _marker.setMarker:

setMarker
=========

.. confval:: setMarker

    ::
    
        <setMarker value="marker value" />
    
    :Type: Default method
    :Description:
        Defines the marker.
    :Attributes:   
        - value (required): the value for the marker. 
  
  
.. _marker.setMarkerByPieces:

setMarkerByPieces
=================

.. confval:: setMarkerByPieces

    ::
    
        <setMarkerByPieces attribute1 .. AttributeN />
    
    :Type: Default method
    :Description:
        Defines the markerby concatenating the attributes.
    :Attributes:
        - Any attribute name can be used. The resulting marker is the concatenation of
          all attribute values.      
        
        In the following exemple, the marker ``myMarkerId`` has the value
        ``Number of pages created per year``.
        
        .. code::
        
            <marker id="myMarkerId">
               <setMarkerByPieces part1="Number of " part2="pages created " part3="per year" />
            </marker>
        
        This method is useful when markers include information from a query, for example. In this case,
        a part is a reference to the data generated by the query.
        
        .. tip::
        
           Using \\n in an attribute value generates a newline break. 
