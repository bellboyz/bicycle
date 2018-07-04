<?php
class Customer_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function delete_customer($delete_id){
        $this->db->where('id', $delete_id);
        $this->db->delete('customer');
        return true;
    }

    public function get_customer($id){
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return false;
        }
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('customer', $data);
    }

    public function get_all_customer(){
        $this->db->select('*');
        $this->db->from('customer');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return false;
        }
    }

    public function check_name($name){
        $this->db->select('name');
        $this->db->from('customer');
        $this->db->where('name', $name);
        $query = $this->db->get();
        if($query->num_rows() > 0) return FALSE;
        else return TRUE;
    }
}