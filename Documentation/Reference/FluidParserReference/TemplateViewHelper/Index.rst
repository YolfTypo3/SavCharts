..  include:: ../../../Includes.txt

..  _templateViewHelper:

:navigation-title: Template ViewHelper

==================================
Template ViewHelper `<c:template>`
==================================

ViewHelper that includes a SAV Charts template.

Go to the source code of this ViewHelper: 
`TemplateViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/TemplateViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the template ViewHelper: 

..  confval:: id
    :name: templateId
    :Type: string
    :required: true
    
    Template id.
    
    
..  confval:: fileName
    :name: templateFileName
    :Type: string
    :default: ''    
    
    File name containing the template
    
Examples
========

The following examples should be included in the 
"Templates" field of the "Fluid Parser" tab 
of the plugin. 

With fileName attribute
-----------------------

..  code-block:: xml    
    
    <c:template id="1" fileName="EXT:sav_charts/Resources/Private/Templates/ChartsExamples/FluidParser/BarChart.fluid" />

Child nodes
-----------

..  code-block:: xml    

    <c:template id="1">
        EXT:sav_charts/Resources/Private/Templates/ChartsExamples/FluidParser/BarChart.fluid
    </c:template>    
    
