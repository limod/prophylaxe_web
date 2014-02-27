<?php

class AppController extends Zend_Controller_Action {

    public function init() {
//        $contextSwitch = $this->_helper->getHelper('contextSwitch');
        //app/get-patient/format/json',
//        $contextSwitch->addActionContext('get-patient', 'json')
//                   ->initContext();
    }

    public function indexAction() {
        // action body
    }

    public function getPatientAction() {
        // Post variablen holen
        $token = $this->getRequest()->getParam('token');
        $email = $this->getRequest()->getParam('email');

        $json = array();


        // Patientendaten
        $patient = new Application_Model_Patient_Patient();
        $patientMapper = new Application_Model_Patient_PatientMapper();
        $patientMapper->findByEmail($email, $patient);


        // Zugehoeriger Notfallkoffer
        $emergencyCaseMapper = new Application_Model_EmergencyCase_EmergencyCaseMapper();
        $emergencyCase = new Application_Model_EmergencyCase_EmergencyCase();
        $emergencyCase = $emergencyCaseMapper->findEmergencyCaseOfPatient($patient->getId());

        // Zugehoerige Sprueche
        $maximMapper = new Application_Model_MaximMapper();
        $maxims = $patientMapper->getMaximsFromPatient($patient->getId());
        foreach ($maxims as $maxim) {
            $json['maxims'][] = $maxim->getKeyValueArray();
        }

        // Zugehoerige Ablenkungen
        $distractions = $patientMapper->getDistractionsFromPatient($patient->getId());
        foreach ($distractions as $distraction) {
            $json['distractions'][] = $distraction->getKeyValueArray();
        }

        $json['patient'] = $patient->getKeyValueArray();
        $json['emergency-case'] = $emergencyCase->getKeyValueArray();


        $this->view->aaData = $json;

        echo json_encode($json, JSON_PRETTY_PRINT);

        echo Zend_Json::encode($json);
        exit();
//        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function testAction() {
        $_POST['token'] = 'FFJJ34';
        $_POST['email'] = 'foo@bar.de';

        $this->getPatientAction();
    }

}
