<?php
class Stock_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function delete_stock($delete_id){
        $this->db->where('id', $delete_id);
        $this->db->delete('stock');
        return true;
    }

    public function get_stock($edit_id){
        $this->db->select('*');
        $this->db->from('stock');
        $this->db->where('id', $edit_id);
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
        $this->db->update('stock', $data);
    }

    public function get_all_stock(){
        $this->db->select('*');
        $this->db->from('stock');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return false;
        }
    }
}