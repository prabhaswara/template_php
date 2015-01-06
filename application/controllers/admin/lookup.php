<?php

class Lookup extends Main_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_lookup');
    }

    public function json_list() {
        $data = $this->m_lookup->w2grid("SELECT * FROM tpl_lookup WHERE ~search~ ORDER BY ~sort~", $_POST);
        header("Content-Type: application/json;charset=utf-8");
        echo json_encode($data);
    }

    public function index() {
        $dataParse=array();
        
        $this->parser->parse('lookup/list', $dataParse);
     
    }
    public function showForm($id) {
        
        $postform=isset($_POST['frm'])?$_POST['frm']:array();
        
        if($id!="0"&& empty($postform)){
            $postform=$this->m_lookup->get($id);
        }
        $dataParse=array('post'=>$postform);
        
        $dataParse["message"]="";
        if(!empty($postform)){
            $validate=$this->m_lookup->validate($postform);
            if($validate["status"] && $this->m_lookup->saveOrUpdate($postform)){
                echo "close_popup";exit;
            }
            $error_message= isset($validate["message"])?$validate["message"]:array();
            if(!empty($error_message)){
                $dataParse["message"]=  showMessage($error_message);
            }
            
        }
        $this->parser->parse('lookup/form', $dataParse);
       
    }
    
    
    public function delete() {
        if(isset($_POST["selected"]))
        $validate=$this->m_lookup->delete($_POST["selected"]);
       
        $this->json_list();
    }
    
}

?>