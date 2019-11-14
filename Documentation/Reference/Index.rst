.. include:: ../Includes.txt

.. _reference:

=========
Reference
=========

In the following sections all tag attributes can take a value or be a reference to a specific tag. 
The allowed syntaxes are:

- tag#id. The attribute value will be replaced by the tag whose id is "id" (tags can be any allowed tag as marker, data, barChart...) .
  See for example the provided template "barCharts.xml" in which there is the following line. The attribute value is replaced by the 
  marker whose id is "labelSet1".
  
   .. code::
  
      <item key="label" value="marker#labelSet1" />
              
- tag#id:integer1. The tag whose id is "id" must be an array.The attribute value will be replaced by the item at the position given by "integer1".
- tag#id:integer1-integer2. The tag whose id is "id" must be an array.The attribute value will be replaced by the sub-array starting at "integer1" and ending at "integer2".
- for#id:value. The tag is replaced by the curent value of the attribute "each" in the <for> tag.
- for#id:key. The tag is replaced by the curent key of the attribute "each" in the <for> tag.
- tag#id:for#idFor:key. The tag whose id is "id" must be an array.The attribute value will be replaced by the item at the position given by key 
  of the current "each" attribute of the <for> tag whose id is "IdFor". 
- tag#id:for#idFor:value. The tag whose id is "id" must be an array.The attribute value will be replaced by the item at the position given by value 
  of the current "each" attribute of the <for> tag whose id is "IdFor". 
  
   .. tip::
  
      Examples of such syntaxes can be found in the file "Resources/Private/ChartsExamples/BarChartAdvanced.xml" 
      which builds a flexible template able to display upto 9 data sets with 9 different colors in the same charts as explained 
      in the tutorial section.
            

Table of Contents
=================

.. toctree::
   :maxdepth: 5
   :titlesonly:
   :glob:

   ChartTags/Index
   DataTags/Index
   ForTags/Index
   MarkerTags/Index
   PluginTags/Index   
   QueryTags/Index
   TemplateTags/Index

















