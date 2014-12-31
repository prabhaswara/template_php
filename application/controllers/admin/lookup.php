<?php

class Lookup extends Main_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_users', 'm_users');
    }

    public function json_list() {
        $data = $this->m_users->w2grid("SELECT * FROM lookup WHERE ~search~ ORDER BY ~sort~", $_POST);
        header("Content-Type: application/json;charset=utf-8");
        echo json_encode($data);
    }

    public function index() {
        $dataParse=array();
        $this->loadview('lookup/list', $dataParse);
    }
    public function showForm() {
        $dataParse=array();
        $this->loadview('lookup/form', $dataParse);
    }
    
    public function delete() {
       $this->json_list();
    }
    
}

?>