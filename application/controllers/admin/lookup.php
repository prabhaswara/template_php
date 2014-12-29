<?php

class Lookup extends Main_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dataParse=array('param'=>"zaaap");
       $this->loadview('lookup/list',$dataParse);
    }

}

?>