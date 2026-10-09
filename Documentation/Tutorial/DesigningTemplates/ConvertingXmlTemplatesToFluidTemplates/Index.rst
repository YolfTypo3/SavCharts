..  include:: ../../../Includes.txt

..  _convertingXmlTemplatesToFluidTemplates:

===========================================
Converting XML Templates to Fluid Templates
===========================================

Converting Basic Templates
==========================

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

Converting Advanced XML Templates to Fluid Templates
====================================================

Advanced templates are designed to display multiple
sets of data on the same chart. Between one and
nine sets of data can be displayed on the same chart.

As colour label sets and data sets are built
iteratively, a special `<for>` was introduced in
the XML Parser. This leads to complex statements
and poor readability.

In Fluid-based templates, however, conventional
Fluid syntax and viewHelpers can be used. Therefore,
using the `<f:for>` viewHelper greatly improves
readability.

Let us illustrate this point with part of the
`LineChartsAdvanced.xml` template. The `<for>`
tags in the following excerpt contain data
with IDs `data` and `labels`, as well as
intermediate data tags with IDs `initData`
and `initLabels`, which are used to build them.

The Fluid-based version uses simpler code
thanks to the `<f:for>` viewHelper.

..  tabs::

    ..  tab:: Fluid Parser

        ..  code-block:: xml

            <!-- Defines the data -->
            <c:data id="data">
                <f:for each="{data__lowIntensityColors}" as="color" key="key">
                    <c:item key="{key}" value="{data__sampleData}" />
                </f:for>
            </c:data>

            <!-- Defines the labels for the set -->
            <f:for each="{data__data}" as="value" key="key"> 
                <c:marker id="labelSet{key}" value="labelSet {key}"/>       
            </f:for> 

    ..  tab:: XML Parser

        ..  code-block:: xml

            <!-- Defines the data -->
            <for id="initData" each="data#lowIntensityColors">
                <data id="initData" overload="1">
                    <item key="for#initData:key" value="data#sampleData" />
                </data>
            </for>
            <data id="data">
                <setData values="data#initData" />
            </data>

            <!-- Defines the labels -->
            <for id="initLabels" each="data#data">
                <marker id="labelSetId" overload="1">
                    <setMarkerByPieces part1="labelSet" part2="for#initLabels:key" />
                </marker>
                <marker id="marker#labelSetId">
                    <setMarkerByPieces part1="Label " part2="for#initLabels:key" />
                </marker>
            </for>

Similarly, the following excerpt shows how data with the ID `dataSets`
were set, using markers with IDs `setId` and `labelSetId`. They
are needed to generate new markers with IDs `labelSet0`, `labelSet1`...
and the items with IDs 0, 1... for `dataSets`.

Once again, Fluid syntax makes it simpler because accessors can
be used in accessors. For example, `{data__lowIntensityColors.{key}}`
returns the value at the position given by `key` in the data with the
ID `lowIntensityColors`. 

..  tabs::

    ..  tab:: Fluid Parser

        ..  code-block:: xml
              
            <!-- Defines the sets -->
            <c:data id="dataSets">
                <f:for each="{data__data}" as="value" key="key">
                    <c:item key="{key}">
                        <c:item key="label" value="{marker__labelSet{key}}" />
                        <c:item key="backgroundColor" value="{data__lowIntensityColors.{key}}" />
                        <c:item key="borderColor" value="{data__fullIntensityColors.{key}}" />                
                        <c:item key="pointColor" value="{data__middleIntensityColors.{key}}" />
                        <c:item key="pointBackgroundColor">#fff</c:item>
                        <c:item key="pointHoverBackgroundColor" value="{data__fullIntensityColors.{key}}" />
                        <c:item key="lineTension" value="false" />
                        <c:item key="data" value="{data__data.{key}}" />
                    </c:item>
                </f:for>
            </c:data>

    ..  tab:: XML Parser

        ..  code-block:: xml
                     
            <!-- Defines the sets -->
            <for id="initSets" each="data#data">     
                <marker id="setId" overload="1">
                    <setMarkerByPieces part1="set" part2="for#initSets:key" />                
                </marker>  
                <marker id="labelSetId" overload="1">
                    <setMarkerByPieces part1="labelSet" part2="for#initSets:key" />                
                </marker>
                      
                <data id="marker#setId">
                    <item key="label" value="marker#marker#labelSetId" />
                    <item key="backgroundColor" value="data#lowIntensityColors:for#initSets:key" />
                    <item key="borderColor" value="data#fullIntensityColors:for#initSets:key" />                
                    <item key="pointColor" value="data#middleIntensityColors:for#initSets:key" />
                    <item key="pointBackgroundColor">#fff</item>
                    <item key="pointHoverBackgroundColor" value="data#fullIntensityColors:for#initSets:key" />
                    <item key="lineTension" value="false" />
                    <item key="data" value="for#initSets:value" />
                </data> 
                <data id="dataSets" overload="1">
                    <item key="for#initSets:key" value="data#marker#setId" />
                </data>                         
            </for>

  