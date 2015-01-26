<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_role extends Main_Model {

    function __construct() {
        parent::__construct();
    }
    function get($id){
        return $this->db->where("role_id",$id)->get("tpl_role")->row_array();
    }
    
    function allrole(){
        return $this->db->select("role_id,name")->get("tpl_role")->result_array();
    }
    
    function comboRole(){
        $data=$this->allrole();
        $return=array();
        foreach($data as $row){
            $return[$row["role_id"]]=$row["name"];
        }
        return $return;
    }
    
  

    public function saveOrUpdate($datafrm) {
        $return=false;
        $role_id = $datafrm["role_id"];
        unset($datafrm["role_id"]);
        
        $this->db->set('dateupdate', 'NOW()', FALSE); 
        if ($role_id == "") {      
            $this->db->set('datecreate', 'NOW()', FALSE);             
            $return=$this->db->insert('tpl_role', $datafrm);
        } else {        
            $return=$this->db->update('tpl_role', $datafrm, array('role_id' => $role_id));
        }
        return $return;
    }
    
    public function delete($selected){
        foreach($selected as $id){
            $this->db->delete( 'tpl_role', array( 'role_id' => $id ) );
        }
    }

    public function validate($datafrm) {
        $return = array(
            'status' => true,
            'message' => array()
        );

        if (!empty($datafrm)) {

             if (cleanstr($datafrm["role_id"]) == "") {
                $return["status"] = false;
                $return["message"]["role_id"] = "ID cannot be empty";
            }
            if (cleanstr($datafrm["name"]) == "") {
                $return["status"] = false;
                $return["message"]["name"] = "Name cannot be empty";
            }

           
           
        }

        return $return;
    }

}

?>