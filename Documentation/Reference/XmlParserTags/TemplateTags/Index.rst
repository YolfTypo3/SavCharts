..     include:: ../../../Includes.txt

..     _templateTags:

=============
Template Tags
=============

..     only:: html

.. _template.template:

..     confval:: template

    ..  code-block:: xml
    
        <template id="myTemplateId">yourFileName.xml</template>
    
    :Type: Object
    :Description:
        Loads the XML template file given inside the XML tag.
        The file name is relative to the site path.
    :Attributes:
        - id (required): the identifier.
    
    It is equivalent to:

    ..  code-block:: xml

        <template id="myTemplateId">
           <loadTemplate fileName="yourFileName.xml"/>
        </template>

     
..     _template.loadTemplate:

..     confval:: loadTemplate

    ..  code-block:: xml
    
        <loadTemplate fileName="yourFileName.xml"/>

    :Type: Default method
    :Description:
        Loads the XML template file given in the fileName attribute.
    :Attributes:
        - fileName (required): the file name is relative to the site path.      
