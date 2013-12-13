<?php

class Application_Model_DbTable_Patient extends Zend_Db_Table_Abstract {

    protected $_name = 'spl_patient';
    protected $_primary = 'patientID';
    // Automatisch hochzaehlender PK
    protected $_sequence = true;
//    protected $_dependentTables = array('MaximHasPatient');

}

