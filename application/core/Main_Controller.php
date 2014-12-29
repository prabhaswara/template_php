<?php


class Main_Controller extends CI_Controller
{
    public $template="main";
	function __construct()
	{
           
		parent::__construct();
	}
        
        function loadview($content,$dataContent=array()){
           
            
            $dataMain['maincontent']=$this->parser->parse($content,$dataContent,TRUE);
            $dataMain['base_url']= base_url(); 
            $this->parser->parse('template/'.$this->template,$dataMain);
        }
}