<?php

class Menu extends Main_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_menu');
    }

    public function json_list() {
        $sql="SELECT * FROM tpl_menu mn left join tpl_menu pp on mn.parent_id=pp.menu_id WHERE ~search~ ORDER BY ~sort~";
        $data = $this->m_menu->w2grid($sql, $_POST,str_replace("*","mn.parent_id" , $sql));
        header("Content-Type: application/json;charset=utf-8");
        echo json_encode($data);
    }

    public function index() {
       
       
        $this->loadContent('menu/list');
     
    }
    public function showForm($id=0) {
        
        $postform=isset($_POST['frm'])?$_POST['frm']:array();
        $message="";
       
              
       
        if(!empty($postform)){
            $validate=$this->m_menu->validate($postform);
            if($validate["status"] && $this->m_menu->saveOrUpdate($postform)){
                echo "close_popup";exit;
            }
            $error_message= isset($validate["message"])?$validate["message"]:array();
            if(!empty($error_message)){
                $message=  showMessage($error_message);
            }
            
        }elseif($id!="0"&& empty($postform)){
            
            $postform=$this->m_menu->get($id);
        
        }
        $dataParse=array(
            'post'=>$postform,
            'message'=>$message,
            'base_url'=>  base_url(),
            'site_url'=> site_url()
            );
        $this->parser->parse('menu/form', $dataParse);
       
    }
    
    
    public function delete() {
        if(isset($_POST["selected"]))
        $validate=$this->m_menu->delete($_POST["selected"]);
       
        $this->json_list();
    }
    
}

?>