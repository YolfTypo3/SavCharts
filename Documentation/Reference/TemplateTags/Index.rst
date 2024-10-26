.. include:: ../../Includes.txt

.. _templateTags:

=============
Template Tags
=============

.. only:: html

   .. contents::
      :depth: 1
      :local:  


.. _template.template:

template
========

.. confval:: template

    ::
    
        <template id="myTemplateId">yourFileName.xml</template>
    
    :Type: Object
    :Description:
        Loads the XML template file given inside the XML tag.
        The file name is relative to the site path.
    :Attributes:
        - id (required): the identifier.  
        
    It is equivalent to:

    .. code::

    	<template id="myTemplateId">
    	   <loadTemplate fileName="yourFileName.xml"/>
    	</template>

     
.. _template.loadTemplate:

loadTemplate
============

.. confval:: loadTemplate

    ::
    
        <loadTemplate fileName="yourFileName.xml"/>

    :Type: Default method
    :Description:
        Loads the XML template file given in the fileName attribute.
    :Attributes:
        - fileName (required): the file name is relative to the site path.      
