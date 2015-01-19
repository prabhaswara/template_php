<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_user extends Main_Model {

    function __construct() {
        parent::__construct();
    }
    function get($id){
        return $this->db->where("user_id",$id)->get("tpl_user")->row_array();
    }
    
    function getByUsername($username){
        return $this->db->where("username",$username)->get("tpl_user")->row_array();
    }
    
    
    public function saveOrUpdate($datafrm) {
        $return=false;
        $user_id = $datafrm["user_id"];
        unset($datafrm["user_id"]);
        
        $this->db->set('dateupdate', 'NOW()', FALSE); 
        if ($user_id == "") {      
            $this->db->set('datecreate', 'NOW()', FALSE);             
            $return=$this->db->insert('tpl_user', $datafrm);
        } else {        
            $return=$this->db->update('tpl_user', $datafrm, array('user_id' => $user_id));
        }
        return $return;
    }
    
    public function delete($selected){
        foreach($selected as $id){
            $this->db->delete( 'tpl_user', array( 'user_id' => $id ) );
        }
    }
    
    

    public function validate($datafrm) {
        $return = array(
            'status' => true,
            'message' => array()
        );

        if (!empty($datafrm)) {

            $userExist=$this->getByUsername($datafrm["username"]);
             if (cleanstr($datafrm["username"]) == "") {
                $return["status"] = false;
                $return["message"]["username"] = "Username cannot be empty";
            }else if(!empty ($userExist)){
                $return["status"] = false;
                $return["message"]["username"] = "Username is not available";
            }
            if (cleanstr($datafrm["password"]) == "") {
                $return["status"] = false;
                $return["message"]["password"] = "Password cannot be empty";
            }

           
           
        }

        return $return;
    }

}

?>