<?php

class User extends Main_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_user','m_lookup','m_role'));
    }
    
    

    public function json_list() {
        $data = $this->m_user->w2grid("SELECT * FROM tpl_user WHERE ~search~ ORDER BY ~sort~", $_POST);
        header("Content-Type: application/json;charset=utf-8");
        echo json_encode($data);
    }

    public function index() {
       
       
        $this->loadContent('user/list');
     
    }
    public function showForm($id=0) {
        
        $postform=isset($_POST['frm'])?$_POST['frm']:array();
        $message="";
        $create_edit=$id==0?"Create":"Edit";
        if(!empty($postform)){
            $validate=$this->m_user->validate($postform);
            if($validate["status"] && $this->m_user->saveOrUpdate($postform)){
                echo "close_popup";exit;
            }
            $error_message= isset($validate["message"])?$validate["message"]:array();
            if(!empty($error_message)){
                $message=  showMessage($error_message);
            }
            
        }elseif($id!="0"&& empty($postform)){
            
            $postform=$this->m_user->get($id);
        
        }
        $activeNonList=$this->m_lookup->comboLookup("active_non");
        $dataParse=array(
            'create_edit'=>$create_edit,
            'activeNonList'=>$activeNonList,
            'post'=>$postform,
            'roles'=>$this->m_role->allrole(),
            'message'=>$message,
            'base_url'=>  base_url(),
            'site_url'=> site_url()
            );
        $this->parser->parse('user/form', $dataParse);
       
    }
    
    
    public function delete() {
        if(isset($_POST["selected"]))
        $validate=$this->m_user->delete($_POST["selected"]);
       
        $this->json_list();
    }
    
}

?>