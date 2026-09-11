..  include:: ../../../../Includes.txt

..  _rangeViewHelper:

:navigation-title: cell.range

===============================
Range ViewHelper <c:cell.range>
===============================

ViewHelper that returns a range of cells.

Go to the source code of this ViewHelper: 
`RangeViewHelper.php
<https://github.com/YolfTypo3/SavCharts/blob/main/Classes/ViewHelpers/Cell/RangeViewHelper.php>`_ (GitHub). 

Arguments
=========

The following arguments are available for the range ViewHelper: 

..  confval:: range
    :name: rangeRange
    :Type: string
    :required: true
    
    Range of cells

..  confval:: nullValue
    :name: rangeNullValue
    :Type: mixed
    :default: null
    
    Value returned in the array entry if a cell doesn't exist

..  confval:: calculateFormulas
    :name: rangeCalculateFormulas
    :Type: boolean
    :default: true
    
    If true, formulas are calculated

..  confval:: formatData
    :name: rangeFormatData
    :Type: boolean
    :default: false
    
    If true, formatting is applied to the cell values

..  confval:: returnCellRef
    :name: rangeReturnCellRef
    :Type: boolean
    :default: false
    
    If false, it returns a simple array of rows and columns indexed by number counting from zero. If true, row and column IDs are kept

..  confval:: ignoreHidden
    :name: rangeIgnoreHidden
    :Type: boolean
    :default: false
    
    If false, values for rows/columns are returned even if they are defined as hidden

..  confval:: search
    :name: rangeSearch
    :Type: mixed
    :default: null
    
    If formatData is true, it provides search string or array

..  confval:: replace
    :name: rangeReplace
    :Type: mixed
    :default: null
    
    If formatData is true, it provides replacement string or array

Examples
========

Inline
------

..  code-block:: xml

    <c:spreadsheet  fileName="EXT:sav_charts/Resources/Private/Templates/ChartsExamples/Spreadsheet.xlsx"> 
        <c:worksheet name="Example2">

            <c:data id="labels" values="{c:cell.range(range:'B2:B5')}" />  
            <c:data id="data" values="{c:cell.range(range:'D2:D5', formatData:true, search:{0:'%',1:','}, replace:{0:'',1:'.'})->c:transpose()}" />

        </c:worksheet>
    </c:spreadsheet>