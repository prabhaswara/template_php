<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_menu extends Main_Model {

    function __construct() {
        parent::__construct();
    }
    
    function strArrayMenuw2ui($arrayMenu){
       
        $string="[";
        foreach($arrayMenu as $key=>$val){
            $string.="id='".$val[""]."',text='".$val[""]."'";
        }
        $string.="],";
        return $string;
        
    }
    
    
    function generateMenu(){
        $dataMentah=$this->db->where("active_non",'1')->get("tpl_menu")->result_array();
        $dataKeyParent=array();
        foreach($dataMentah as $row){
            $dataKeyParent[$row['parent_id']][$row['order_num']]=$row;
        }
           
       
        $menujadi=$this->loopMenu("0",$dataKeyParent);
        return $menujadi;
    }
    
            
    function loopMenu($parent_id,$dataKeyParent){
        $datareturn=array();
               
        if(isset($dataKeyParent[$parent_id]))
            foreach($dataKeyParent[$parent_id] as $order=>$dataMenu){
         
                $datareturn[$order]=$dataMenu;
                $datareturn[$order]['child']=$this->loopMenu($dataMenu["menu_id"],$dataKeyParent);
                if(empty($datareturn[$order]['child'])){
                    unset($datareturn[$order]['child']);
                }
            }
        ksort($datareturn);
        return $datareturn;
        
    }
    
    

}

?>