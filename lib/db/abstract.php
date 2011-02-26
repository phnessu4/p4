<?php
/**
 * db connect abstract
 * @author p4	phnessu4@gmail.com
 */
abstract class db_abstract extends core_object {
    protected $_connected = false;

    abstract protected function do_connect() {}

    abstract protected function do_close() {}

    public function connect() {
        if (! $this->_connected) {
            $this->_connected = $this->do_connect ();
        }
        return $this->_connected;
    }

    public function close() {
        if ($this->_connected) {
            $this->do_close ();
        }
    }

    public function is_connected() {
        if ($this->_connected) {return true;}
        return false;
    }
}
?>