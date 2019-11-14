
#
# Table structure for table 'tx_savcharts_domain_model_database'
#
CREATE TABLE tx_savcharts_domain_model_database (
    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) unsigned DEFAULT '0' NOT NULL,
    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(10) DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    title tinytext,
    driver tinytext,
    tables text,
    host tinytext,
    port int(11) DEFAULT '0' NOT NULL,
    socket tinytext,
    name tinytext,
    username tinytext,
    userpassword tinytext,
    persistent tinyint(3) DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_savcharts_domain_model_query'
#
CREATE TABLE tx_savcharts_domain_model_query (
    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) unsigned DEFAULT '0' NOT NULL,
    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    sorting int(10) DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    title tinytext,
    database_id int(11) DEFAULT '0' NOT NULL,
    select_clause text,
    from_clause text,
    where_clause text,
    groupby_clause text,
    orderby_clause text,
    limit_clause text,

    PRIMARY KEY (uid),
    KEY parent (pid)
);


