<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_users extends Main_Model{
    function __construct(){
        parent::__construct();
    }
    
   
    
    public function validate(){
        
        $this->load->model('navigation_model');        
        $nav_menu = $this->navigation_model->generateMenu();        
      
            
        // grab user input
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        
        // Prep the query
        $this->db->where('username', $username);
        $this->db->where('password', md5($password) );        

        $query = $this->db->get('users');   
       
        if($query->num_rows == 1)
        {
            
            $row = $query->row();
            $data = array(                          
                    'username' => $row->username,
                    'validated' => true,
                    'nav_menu' =>$nav_menu
                    );
            $this->session->set_userdata($data);
            return true;
        }   
       
        return false;
    }
}
?>