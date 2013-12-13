<?php

class PatientController extends Zend_Controller_Action {

    public function init() {
        $contextSwitch = $this->_helper->getHelper('contextSwitch');
        $contextSwitch->addActionContext('getpatients', 'json')
                ->initContext();
    }

    public function indexAction() {
        $patient = new Application_Model_PatientMapper();
        $this->view->entries = $patient->fetchAll();
    }

    public function createAction() {


        $request = $this->getRequest();
        $form = new Application_Form_Patient();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $patient = new Application_Model_Patient($form->getValues());
                $mapper = new Application_Model_PatientMapper();
                $mapper->save($patient);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }

    public function editAction() {
        $patientID = $this->getParam('id');

        $form = new Application_Form_Patient();
        $request = $this->getRequest();

        // Wenn das Formular abgesedet wurde, neue Daten Speichern
        // Wenn kein post Request vorliegt => Erster Seitenaufruf, Patient wird anhand der uebergebenen ID ins Formular eingetragen.

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $patient = new Application_Model_Patient($form->getValues());
                $mapper = new Application_Model_PatientMapper();
                $mapper->save($patient);
                return $this->_helper->redirector('index');
            }
        } else {
            $patient = new Application_Model_Patient();
            $mapper = new Application_Model_PatientMapper();
            $mapper->find($patientID, $patient, 'array');


            $form->populate($patient->getKeyValueArray());
        }

        $this->view->form = $form;
    }

    /*
     * Liefert alle Patienten als JSON-Format fuer PatientTable.js
     */

    public function getpatientsAction() {

        $patienten = new Application_Model_PatientMapper();
        $daten = $patienten->fetchAll();

        $json = array();
        foreach ($daten as $value) {
            $json[] = $value->getArray();
        }

        $this->view->aaData = $json;
    }

    public function listAction() {
        //        $this->view->headScript()->appendFile('/js/PatientTable.js');
        $this->view->jQuery()->addJavascriptFile('/js/datatable/jquery.dataTables.min.js');
        $this->view->jQuery()->addStylesheet('/css/jquery.dataTables.css');

        $this->view->jQuery()->addJavascriptFile('/js/PatientTable.js');
    }

}

