<?php
class Billing_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function getNumRows(){
        $this->db->from('billing');
        $this->db->group_by('bill_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function check_depID($id){
        $this->db->from('billing');
        $this->db->where('bill_id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0) return true;
        else return false;
    }

    public function search_billing($cus_id, $start_date, $end_date){
        $this->db->select('b.bill_id, sum(d.price) as total');
        $this->db->from('billing b');
        $this->db->join('deposit d', 'b.bill_id = d.bill_id');
        $this->db->where('b.cus_id', $cus_id);
        if($start_date != '' && $end_date != ''){
            $this->db->where('b.created_date BETWEEN "' . $start_date . '" AND "' . $end_date . '"');
        }
        else if($start_date != '' && $end_date == ''){
            $this->db->where('b.created_date >=', $start_date);
        }
        else if($start_date == '' && $end_date != ''){
            $this->db->where('b.created_date <=', $end_date);
        }
        $this->db->group_by('b.bill_id');
        $query = $this->db->get();
        return $query->result();
    }
}