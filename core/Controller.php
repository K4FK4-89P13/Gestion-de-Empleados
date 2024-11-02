<?php

class Controller {

    // public function __construct() {

    //     $this->start_session();
    // }

    // protected function start_session() {
    //     if (session_status() == PHP_SESSION_NONE) {
    //         session_start();
    //     }
    // }

    public function load_model($model) {

        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    public function load_view($view, $data = []) {

        require_once '../app/views/' . $view . '.php';
    }
}