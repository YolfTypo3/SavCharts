.. include:: ../../Includes.txt

.. _templateTags:


=============
Template Tags
=============

================================= ================ =================================================
Tag                               Data type        Description                 
================================= ================ =================================================
:ref:`template.template`          Object           Creates a template object.
:ref:`template.loadTemplate`      Default method   Loads the template file name.
================================= ================ =================================================


.. _template.template:

template
========

.. container:: table-row

  Property
    <template id="myTemplateId">yourFileName.xml</template>
    
  Data type
    Object
     
  Description
    Loads the XML template file given inside the XML tag.
    The file name is relative to the site path.
    
    Attributes:
    
    - id (required): the identifier.  
        
    It is equivalent to:

    .. code::

    	<template id="myTemplateId">
    	   <loadTemplate fileName="yourFileName.xml"/>
    	</template>

     
.. _template.loadTemplate:

loadTemplate
============

.. container:: table-row

  Property
    <loadTemplate fileName="yourFileName.xml"/>

  Data type
    Default method

  Description
    Loads the XML template file given in the fileName attribute.
    
    Attributes:
    
    - fileName (required): the file name is relative to the site path.      




