<?php

class home extends Main_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_menu');
    }

    public function redirect($menu_id) {
        $menu = $this->m_menu->get($menu_id);
        if (isset($menu['url']) && cleanstr($menu['url']) != "") {
            redirect($menu['url']);
        }
    }

    public function index() {
       
        $this->loadview('home', $dataParse);
    }
    
    

}

?>