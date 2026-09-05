..  include:: ../../../Includes.txt

..  _convertingAdvancedXmlTemplatesToFluidTemplates:

====================================================
Converting Advanced XML Templates to Fluid Templates
====================================================

Advanced templates are designed to display multiple
sets of data on the same chart. Between one and
nine sets of data can be displayed on the same chart.

As colour label sets and data sets are built
iteratively, a special "<for>" was introduced in
the XML parser. This leads to complex statements
and poor readability.

In Fluid-based templates, however, conventional
Fluid syntax and viewHelpers can be used. Therefore,
using the "<f:for>" viewHelper greatly improves
readability.

Let us illustrate this point with part of the
"LineChartsAdvanced.xml" template. The "<for>"
tags in the following excerpt contain data
with ids "data" and "labels", as well as
intermediate data tags with ids "initData"
and "initLabels", which are used to build them.

The Fluid-based version uses simpler code
thanks to the "<f:for>" viewHelper.

..  tabs::

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

    ..  tab:: Fluid parser

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



Similarly, the following excerpt shows how data with the id "dataSets"
were set, using markers with ids "setId" and "labelSetId". They
are needed to generate new markers with ids "labelSet0", "labelSet1"...
and the items with ids 0, 1... for "dataSets".

Once again, Fluid syntax makes it simpler because accessors can
be used in accessors. For example, "{data__lowIntensityColors.{key}}"
returns the value at the position given by "key" in the data with the
id "lowIntensityColors". 

..  tabs::

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

    ..  tab:: Fluid parser

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
        