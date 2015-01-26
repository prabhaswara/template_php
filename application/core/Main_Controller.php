<?php

class Main_Controller extends CI_Controller {

    public $template = "w2layout";

    function __construct() {
        parent::__construct();
        $this->load->helper('gn_frm','gn_str');
        $this->load->model('m_menu');
    }

    function loadContent($content, $dataContent = array()) {
       
        $sessionUserData=$this->session->userdata('userdata');
        $dataMain['base_url'] = base_url();
        $dataMain['site_url'] = site_url();
        $dataMain['ses_userdata'] = $sessionUserData["user"];
        $dataMain['ses_role'] = $sessionUserData["role"];
        
        $this->parser->parse($content, $dataMain);
    }
    
    function loadview($content, $dataContent = array()) {
       
        $dataContent['site_url'] = site_url();
        $dataContent['base_url'] = base_url();
        
        $dataMain['maincontent'] = $this->parser->parse($content, $dataContent, TRUE);
        $dataMain['base_url'] = base_url();
        $dataMain['site_url'] = site_url();
        
        $sessionUserData=$this->session->userdata('userdata');
        $dataMain['ses_userdata'] = $sessionUserData["user"];
        $dataMain['ses_roles'] = $sessionUserData["roles"];
        
        $sideMenu=$this->m_menu->strArrayMenuw2ui($this->m_menu->generateMenu());
        $sideMenu=  substr($sideMenu, 0,  strlen($sideMenu)-1);        
        $dataMain["sideMenu"]=$sideMenu;
        
        $this->parser->parse('template/' . $this->template, $dataMain);
    }

}
