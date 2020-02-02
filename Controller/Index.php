<?php

class Controller_Index extends Controller_Base {
    public function __construct() {
        parent::__construct();
    }

    public function action_index() {
        $this->scripts[] = '/Assets/js/index/index.js';
        $this->render('index/index');
    }
}