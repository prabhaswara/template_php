<?php

class home extends Main_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_menu');
    }

    public function index() {
        $dataParse=array();        
        $this->loadview('home', $dataParse);
    }
    public function sidebar(){
        $this->m_menu->generateMenu();
    }
    
    
    
}

?>