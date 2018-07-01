<?php
class Billing_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function getNumRows(){
        $bill_id_format = 'B' . date('Ym');
        $this->db->from('billing');
        $this->db->like('bill_id', $bill_id_format, 'after');
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
        if($start_date){
            $start_date = explode('/', $start_date);
            $year = $start_date[2];
            $month = $start_date[1];
            $date = $start_date[0];
            $start_date = $year . '-' . $month . '-' . $date;
        }

        if($end_date){
            $end_date = explode('/', $end_date);
            $year = $end_date[2];
            $month = $end_date[1];
            $date = $end_date[0];
            $end_date = $year . '-' . $month . '-' . $date;
        }

        $this->db->select('b.bill_id, b.location, sum(d.price) as total');
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

    public function get_report_billing($cus_id, $stock_id, $start_date, $end_date){
        if($start_date){
            $start_date = explode('/', $start_date);
            $year = $start_date[2];
            $month = $start_date[1];
            $date = $start_date[0];
            $start_date = $year . '-' . $month . '-' . $date;
        }

        if($end_date){
            $end_date = explode('/', $end_date);
            $year = $end_date[2];
            $month = $end_date[1];
            $date = $end_date[0];
            $end_date = $year . '-' . $month . '-' . $date;
        }

        $this->db->select('c.name, b.bill_id, b.created_date, SUM(d.price) as price');
        $this->db->from('billing b');
        $this->db->join('deposit d', 'd.bill_id = b.bill_id');
        $this->db->join('customer c', 'c.id = b.cus_id');
        if($cus_id != ''){
            $this->db->where('b.cus_id', $cus_id);
        }
        if($stock_id != ''){
            $this->db->where('d.stock_id', $stock_id);
        }
        if($start_date != '' && $end_date != ''){
            $this->db->where('b.created_date BETWEEN "' . $start_date . '" AND "' . $end_date . '"');
        }
        else if($start_date != '' && $end_date == ''){
            $this->db->where('b.created_date >=', $start_date);
        }
        else if($start_date == '' && $end_date != ''){
            $this->db->where('b.created_date <=', $end_date);
        }
        $this->db->group_by('b.id');
        $this->db->order_by('b.cus_id', 'b.created_date');
        $query = $this->db->get();
        return $query->result();
    }
}