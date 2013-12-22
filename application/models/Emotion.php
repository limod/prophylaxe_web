<?php

class Application_Model_Emotion {

    protected $_emotionID;
    protected $_emotion;

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Ungültige Emotion Eigenschaft');
        }
        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Ungültige Emotion Eigenschaft');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setEmotion($emotion) {
        $this->_emotion = (string) $emotion;
        return $this;
    }

    public function getEmotion() {
        return $this->_emotion;
    }

    public function setId($id) {
        if ($id > 0) {
            $this->_emotionID = (int) $id;
        } else {
            $this->_emotionID = null;
        }
        return $this;
    }

    public function getId() {
        return $this->_emotionID;
    }

    public function getArray() {
        return array($this->getId(), $this->getEmotion());
    }

}

