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
        $data=$this->m_menu->generateMenu();
        
        $arrayMenu=$this->m_menu->tow2uimenu($data);
        
        echo json_encode($data,4);
         print_r($arrayMenu);
    }
    
    
    
}

?>