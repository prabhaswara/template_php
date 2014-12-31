<?php

class Main_Controller extends CI_Controller {

    public $template = "main";

    function __construct() {

        parent::__construct();
    }

    function loadview($content, $dataContent = array()) {

       
        $dataContent['site_url'] = site_url();
        $dataContent['base_url'] = base_url();
        
        $dataMain['maincontent'] = $this->parser->parse($content, $dataContent, TRUE);
        $dataMain['base_url'] = base_url();
        $dataMain['site_url'] = site_url();
        $this->parser->parse('template/' . $this->template, $dataMain);
    }

}
