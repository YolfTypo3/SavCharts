.. include:: ../../Includes.txt

.. _dataTags:

=========
Data Tags
=========

================================= ================ =================================================
Tag                               Data type        Description
================================= ================ =================================================
:ref:`data.data`                  Object           Creates a data object.
:ref:`data.setData`               Default method   Defines the data.
:ref:`data.callback`              Method           Defines callback function.
:ref:`data.changeToPercentage`    Method           Changes the data to percentage.
:ref:`data.item`              	  Method           Inserts a data item.
:ref:`data.setDataFromQuery`      Method           Defines the data from a query.
:ref:`data.setDataFromQueryRow`   Method           Defines the data from the fields in a query row.
================================= ================ =================================================


.. _data.data:

data
====

.. container:: table-row

  Property
    <data id="myDataId">5,6,7</data>

  Data type
    Object

  Description
    Creates a data object from a comma separated list of data.

    Attributes:

    - id (required): the identifier.

    It is equivalent to:

    .. code::

    	<data id="myDataId">
    		<setData values="5,6,7"/>
    	</template>



.. _data.setData:

setData
=======

.. container:: table-row

  Property
    <setData values="5,6,7" />

  Data type
    Default method

  Description
    Sets the values from a comma separated list of data.

    Attributes:

    - values (required): comma separated list of data.


.. _data.callback:

callback
========

.. container:: table-row

  Property
    <callback key="callbackKey">callbackFileName.js</callback>
    <callback key="callbackKey"><!-- javascript function --></callback>

  Data type
    Method


  Description
    Defines a callback. The javacript function can be provided by means of a file name or
    inserted inserted inline inside a XML comment (see the FAQ section for an example).

    Attributes:

    - key (required): the key for the callback.



.. _data.changeToPercentage:

changeToPercentage
==================

.. container:: table-row

  Property
    <changeToPercentage />

  Data type
    Method


  Description
    Changes the data to percentage.

    Attributes:

    - precision: the precision for rounding floats (default value is 1).



.. _data.item:

item
====

.. container:: table-row

  Property
    <item key="myKey" value="tag#id" /> or
    <item key="myKey" value="5" /> or
    <item key="myKey" values="1, 3, 5" /> or
    <item key="myKey">5</item>

  Data type
    Method

  Description
    Sets a data item either by means of a reference, a value or a comma-separated list of values.

    Attributes:

    - key (required): the key for the item.
    - value: if set, the value is defined directly or by the reference, for example ``data#myDataId``.
      If value is equal to ``true`` or ``false`` then a boolean value is generated for this item.
    - type: if this attribute is equal to ``function``, the value attribute is taken as
      the name of a javascript function.
    - values: if set, a comma-sparated list of values is assumed.
    - if no value or values attribute is provided, the tag childs can be a value or other <item> tags.



.. _data.setDataFromQuery:

setDataFromQuery
================

.. container:: table-row

  Property
    <setDataFromQuery query="myQueryId" field="fieldName" />

  Data type
    Method


  Description
    Defines the data from a query.

    Attributes:

    - query (required): the query identifier.
    - field (required): the field to extract from the query result.
    - groupby: it set, either the size of the reference defined by the tag and the id, for example "data#myDataId",
      or the given integer, will be used to group the data. It means that an new array element will be generated
      each time the count is reached. This option is useful to display data when GROUP BY clause is used in the query.


.. _data.setDataFromQueryRow:

setDataFromQueryRow
===================

.. container:: table-row

  Property
    <setDataFromQueryRow query="myQueryId" fields="fieldName1, fieldName2, fieldName3" />

  Data type
    Method


  Description
    Defines the data from the row of a query.

    Attributes:

    - query (required): the query identifier.
    - fields (required): the comma-separated list of fields to extract from the query row.

