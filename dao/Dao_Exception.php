<?php

class Dao_Exception extends Exception {

    protected $message;
    protected $code;

    function __construct($message, $code) {
        parent::__construct($message, $code, null);
        $this->message = $message;
        $this->code = $code;
    }

    public function __toString() {
        if ($this->code == 1) {
            return __CLASS__ . ": The $this->message cannot be duplicated.";
        } else if ($this->code == 2) {
            return __CLASS__ . ": The $this->message cannot be inserted on the database.";
        } else if ($this->code == 3) {
            return __CLASS__ . ": The object is not a $this->message.";
        } else if ($this->code == 4) {
            return __CLASS__ . ": The select query for $this->message has incorrect syntax.";
        } else if ($this->code == 5) {
            return __CLASS__ . ": The $this->message type is not correct.";
        }
    }

}
