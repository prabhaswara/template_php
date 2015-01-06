<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_lookup extends Main_Model {

    function __construct() {
        parent::__construct();
    }
    function get($id){
        return $this->db->where("lookup_id",$id)->get("tpl_lookup")->row_array();
    }

    public function saveOrUpdate($datafrm) {
        $return=false;
        $lookup_id = $datafrm["lookup_id"];
        unset($datafrm["lookup_id"]);
        
        $this->db->set('dateupdate', 'NOW()', FALSE); 
        if ($lookup_id == "") {      
            $this->db->set('datecreate', 'NOW()', FALSE);             
            $return=$this->db->insert('tpl_lookup', $datafrm);
        } else {        
            $return=$this->db->update('tpl_lookup', $datafrm, array('lookup_id' => $lookup_id));
        }
        return $return;
    }
    
    public function delete($selected){
        foreach($selected as $id){
            $this->db->delete( 'tpl_lookup', array( 'lookup_id' => $id ) );
        }
    }

    public function validate($datafrm) {
        $return = array(
            'status' => true,
            'message' => array()
        );

        if (!empty($datafrm)) {

            if (cleanstr($datafrm["type"]) == "") {
                $return["status"] = false;
                $return["message"]["type"] = "Type cannot be empty";
            }

            if (cleanstr($datafrm["value"]) == "") {
                $return["status"] = false;
                $return["message"]["value"] = "Value cannot be empty";
            }

            if (cleanstr($datafrm["display_text"]) == "") {
                $return["status"] = false;
                $return["message"]["display_text"] = "Display text cannot be empty";
            }
        }

        return $return;
    }

}

?>