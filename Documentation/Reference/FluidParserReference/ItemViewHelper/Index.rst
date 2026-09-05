..  include:: ../../../Includes.txt

..  _itemViewHelper:

:navigation-title: Item ViewHelper

========================
Item ViewHelper <c:item>
========================

ViewHelper which defines items.

Go to the source code of this ViewHelper: 
`ItemViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/ItemViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the item ViewHelper: 

..  confval:: key
    :name: itemKey
    :Type: string
    :required: true
    
    Item key    

..  confval:: value
    :name: itemValue
    :Type: mixed
    
    Item value

..  confval:: values
    :name: itemValues
    :Type: string
    
    Item comma-separated values        
     
Examples
========

With values attribute
---------------------

..  code-block:: xml
    
    <c:data id="data">
        <item key="0" values="1, 6, 8, 3" />
        <item key="1" values="2, 4,10, 5" />
    </c:data>
        
With value attribute
---------------------

..  code-block:: xml
    
    <c:data id="data">
        <c:item key="0" value="{data__set0}" />
        <c:item key="1" value="{data__set1}" />
    </c:data>
        
Child nodes
-----------

..  code-block:: xml
    
    <c:data id="lowIntensityColors">
        <c:item key="0">rgba(77, 77, 77, 0.2)</c:item>
        <c:item key="1">rgba(93, 165, 218, 0.2)</c:item>
        <c:item key="2">rgba(250, 164, 58, 0.2)</c:item>
    </c:data>

..  code-block:: xml
    
    <c:data id="lineChartOptions">
        <c:item key="scales"> 
            <c:item key="y">
                <c:item key="max" value="100" /> 
                <c:item key="min" value="10" />
                <c:item key="ticks">      
                    <c:item key="stepSize" value="5" />
                </c:item>
            </c:item>
             <c:item key="x">
                <c:item key="ticks">
                     <c:item key="font">
                           <c:item key="size" value="15" />
                           <c:item key="style" value="italic" />
                     </c:item>
                     <c:item key="color" value="rgb(200, 0, 0)" />
                     <c:callback key="callback">
                        function(value, index, values) {
                            return '- ' + this.getLabelForValue(value) + ' -';
                        }
                     </c:callback>
                  </c:item>
            </c:item>
        </c:item>
    </c:data>            