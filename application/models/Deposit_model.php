<?php
class Deposit_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function getNumRows(){
        $this->db->from('deposit');
        $this->db->group_by('dep_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function check_depID($id){
        $this->db->from('deposit');
        $this->db->where('dep_id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0) return true;
        else return false;
    }

    public function get_deposit($cus_id, $start_date, $end_date){
        $query = $this->db->query('SELECT dep_id, price, created_date FROM deposit WHERE cus_id = ' . $cus_id . ' AND created_date BETWEEN "' . $start_date . '" AND "' . $end_date . '"');
        return $query->result();
    }

    public function update_bill($dep_id, $data){
        $this->db->where('dep_id', $dep_id);
        $this->db->update('deposit', $data);
    }
}