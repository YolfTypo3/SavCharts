..  include:: ../../../Includes.txt

..  _queryViewHelper:

:navigation-title: Query ViewHelper

========================
Query ViewHelper <c:query>
========================

ViewHelper which defines queries.

Go to the source code of this ViewHelper: 
`QueryViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/QueryViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the query ViewHelper: 

..  confval:: id
    :name: queryId
    :Type: string
    :required: true
    
    Query ID    

..  confval:: manager
    :name: queryManager
    :Type: string
        
    Query manager

..  confval:: uid
    :name: queryUid
    :Type: string
    
    UID of the query record        

..  note::
    
    The query will only be processed if the manager 
    and UID arguments are provided. These arguments 
    are not defined as `required` for compatibility 
    with the XML parser.

Example
=======

..  code-block:: xml
    
    <c:query id="1"  manager="savcharts" uid="1" />    
    
    <c:data id="labels" values="{query__1.Year}" />
    <c:data id="data">
          <c:item key="0" value="{query__1.Count}" />
    </c:data>    
        