<?php

class home extends Main_Controller {

    public function __construct() {
        parent::__construct();       
    }

    public function index() {
        $dataParse=array();        
        $this->loadview('home', $dataParse);
    }
    public function sidebar(){
        
    }
    
    
    
}

?>