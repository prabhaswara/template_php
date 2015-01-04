<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_lookup extends Main_Model {

    function __construct() {
        parent::__construct();
    }

    public function saveOrUpdate($datafrm) {
        $return=false;
        $lookup_id = $datafrm["lookup_id"];
        unset($datafrm["lookup_id"]);
        if ($lookup_id == "") {          
            $return=$this->db->insert('lookup', $datafrm);
        } else {
            $return=$this->db->update('lookup', $datafrm, array('lookup_id' => $lookup_id));
        }
        return $return;
    }
    
    public function delete($selected){
        foreach($selected as $id){
            $this->db->delete( 'lookup', array( 'lookup_id' => $id ) );
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

            if (cleanstr($datafrm["name"]) == "") {
                $return["status"] = false;
                $return["message"]["name"] = "Name cannot be empty";
            }
        }

        return $return;
    }

}

?>