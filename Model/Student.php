<?php

class Model_Student extends Model_Base {
    public function __construct() {
        parent::__construct();
    }

    public function get_list() {
        return $this->db->getAll("SELECT * FROM students");
    }
}