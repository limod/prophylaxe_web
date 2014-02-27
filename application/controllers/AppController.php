<?php

class AppController extends Zend_Controller_Action
{

    public function init()
    {
//        $contextSwitch = $this->_helper->getHelper('contextSwitch');

        //app/get-patient/format/json',

//        $contextSwitch->addActionContext('get-patient', 'json')
//                   ->initContext();
    }

    public function indexAction()
    {
        // action body
    }

    public function getPatientAction()
    {
        // Post variablen holen
        $token = $this->getRequest()->getParam('token');
        $email = $this->getRequest()->getParam('email');
        
        $json = array();
        
        $emergencyCaseMapper = new Application_Model_EmergencyCase_EmergencyCaseMapper();
        
        $patient = new Application_Model_Patient_Patient();
        $patientMapper = new Application_Model_Patient_PatientMapper();
        $patientMapper->findByEmail($email, $patient);

        $json['id'] = '1';
        $json['name'] = 'dummi';


        $this->view->aaData = $json;
        
        echo Zend_Json::encode($json);	
        exit();
//        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function testAction()
    {
        $_POST['token'] = 'FFJJ34';
        $_POST['email'] = 'foo@bar.de';
        
        $this->getPatientAction();
    }


}


