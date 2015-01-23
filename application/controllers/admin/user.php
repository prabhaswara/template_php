<?php

class User extends Main_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_user','m_lookup','m_role'));
    }
    
    

    public function json_list() {
        if(isset($_POST["sort"])&& !empty($_POST["sort"]))
            foreach($_POST["sort"] as $key=>$value){
                $_POST["sort"][$key]=  str_replace("_sp_", ".", $value);
            }
        
        
        if(isset($_POST["search"])&& !empty($_POST["search"]))
        foreach($_POST["search"] as $key=>$value){
            $_POST["search"][$key]=  str_replace("_sp_", ".", $value);
        }
        
        $sql="SELECT us.user_id us_sp_user_id,us.username us_sp_username,us.last_login us_sp_last_login ,lk.display_text lk_sp_display_text,GROUP_CONCAT(rl.name SEPARATOR ', ')rl_sp_role_name FROM tpl_user us left join tpl_lookup lk on lk.value=us.active_non and lk.type='active_non' left join tpl_user_role  ur on us.user_id=ur.user_id left join tpl_role rl on ur.role_id=rl.role_id  WHERE ~search~ group by us.user_id ,us.username ,us.last_login  ,lk.display_text  ORDER BY ~sort~";
        $data = $this->m_menu->w2grid($sql,$_POST);
        header("Content-Type: application/json;charset=utf-8");
        echo json_encode($data);
    }

    public function index() {     
       $this->loadContent('user/list');     
    }
    
    public function chooseUserRole() {     
       $this->loadContent('user/chooseUserRole');     
    }
    public function showForm($id=0) {     
        
        $message="";
        $session_message=$this->session->userdata('message');
        if($session_message!=null){
            $this->session->unset_userdata('message');
            
            $message=  showMessage($session_message[0],$session_message[1]);
        }
        
        $postUser=isset($_POST['frm'])?$_POST['frm']:array();
        $postUserRole=isset($_POST['role'])?$_POST['role']:array();
       
        $create_edit="Edit";
        $isEdit=true;
        if($id==0){
             $create_edit="Create";
                $isEdit=false;
        }
        
        
        if(!empty($postUser)){
            $validate=$this->m_user->validate($postUser,$isEdit);
            if($validate["status"]){
                $dataSave["user"]=$postUser;
                $dataSave["user"]["password"]=$postUser["password_1"];
                unset($dataSave["user"]["password_1"]);
                unset($dataSave["user"]["password_2"]);              
                
                $dataSave["role"]=$postUserRole;
               
               $result=$this->m_user->saveOrUpdate($dataSave);
               
               if($result){
                   $this->session->set_userdata("message",array("Data Saved","success"));
                   redirect("admin/user/showForm");
               }
               
            }
            $error_message= isset($validate["message"])?$validate["message"]:array();
            if(!empty($error_message)){
                $message=  showMessage($error_message);
            }
            
        }elseif($id!="0"&& empty($postUser)){
            
            $postUser=$this->m_user->get($id);
            $postUserRole=$this->m_user->getRoleUser($id);
          
        
        }
        $activeNonList=$this->m_lookup->comboLookup("active_non");
        $dataParse=array(
            'create_edit'=>$create_edit,
            'activeNonList'=>$activeNonList,
            'postUser'=>$postUser,
            'postUserRole'=>$postUserRole,
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