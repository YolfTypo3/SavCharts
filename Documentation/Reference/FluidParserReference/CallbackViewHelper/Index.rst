..  include:: ../../../Includes.txt

..  _callbackViewHelper:

:navigation-title: Callback ViewHelper

==================================
Callback ViewHelper `<c:callback>`
==================================

ViewHelper that includes a JavaScript function.

Go to the source code of this ViewHelper: 
`CallbackViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/CallbackViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the callback ViewHelper: 

..  confval:: key
    :name: callbackKey
    :Type: string
    :required: true
    
    Callback key    

..  confval:: fileName
    :name: callbackFileName
    :Type: string
    :default: ''    

    File name containing the JavaScript function

Examples
========

With fileName attribute
-----------------------

The JavaScript function must be in the given file name.

..  code-block:: xml    
    
    <c:item key="tooltip">
        <c:item key="callbacks">
            <c:callback key="label" fileName="EXT:sav_charts/Resources/Public/Callbacks/TooltipLabel.js" />
        </c:item>
    </c:item>

Child nodes
-----------

The JavaScript function is provided in the child node.

..  code-block:: xml    
    
    <c:item key="tooltip">
        <c:item key="callbacks">
            <c:callback key="label">
                function(context) {
                    return context.label + ' - ' + context.formattedValue + ' €';
                }
            </c:callback>        
        </c:item>            
    </c:item>    
