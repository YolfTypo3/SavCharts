..  include:: ../../../Includes.txt

..  _convertingBasicXmlTemplatesToFluidTemplates:

=================================================
Converting Basic XML Templates to Fluid Templates
=================================================

Introduction
============

The conversion process is quite simple.

-   Prefix all tags with `c:`.
-   References are written as `tag__id` instead of `tag#id`. 
    This change is because the character # is not permitted in Fluid variable names. 
-   To get the value associated with a reference, use the
    conventional Fluid accessor for variables, i.e. `{tag__id}`.

..  note::
    
    Parameters in chart tags (data, options, width, and height),
    can be values or references.

    -   If they are values, they must be specified directly, for example width="600",
        or obtained using an accessor. For example 
        {data__width} can be used if <c:data id="width" value="600"/> 
        is called before the chart tag.
    -   As references, the related tags can be defined before 
        or inside the chart tag. Therefore, the best 
        practice for `data` and `options` is to always
        use references.
     
See :ref:`Designing Templates from Examples <_designingTemplatesFromExamples>`.  

  