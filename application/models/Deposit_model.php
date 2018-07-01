<?php
class Deposit_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function getNumRows(){
        $dep_id_format = 'D' . date('Ym');
        $this->db->from('deposit');
        $this->db->like('dep_id', $dep_id_format, 'after');
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

    public function get_deposit_by_dep_id($dep_id){
        $this->db->select('*');
        $this->db->from('deposit');
        $this->db->where('dep_id', $dep_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_deposit($cus_id, $start_date, $end_date){
        $this->db->select('*');
        $this->db->from('deposit');
        $this->db->where('cus_id', $cus_id);
        if($start_date != '' && $end_date != ''){
            $this->db->where('created_date BETWEEN "' . $start_date . '" AND "' . $end_date . '"');
        }
        else if($start_date != '' && $end_date == ''){
            $this->db->where('created_date >=', $start_date);
        }
        else if($start_date == '' && $end_date != ''){
            $this->db->where('created_date <=', $end_date);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function update_bill($dep_id, $data){
        $this->db->where('dep_id', $dep_id);
        $this->db->update('deposit', $data);
    }

    public function search_deposit($id, $cus_id, $start_date, $end_date, $check){
        if($check == 'deposit') $this->db->select('dep_id, location, sum(price) as total');
        $this->db->from('deposit');
        $this->db->where('cus_id', $cus_id);
        if($id != ''){
            if($check == 'deposit') $this->db->where('dep_id', $id);
            else $this->db->where('bill_id', $id);
        }
        if($start_date != '' && $end_date != ''){
            $this->db->where('created_date BETWEEN "' . $start_date . '" AND "' . $end_date . '"');
        }
        else if($start_date != '' && $end_date == ''){
            $this->db->where('created_date >=', $start_date);
        }
        else if($start_date == '' && $end_date != ''){
            $this->db->where('created_date <=', $end_date);
        }
        if($check == 'deposit') $this->db->group_by('dep_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_report_deposit($stock_id, $start_date, $end_date){
        $this->db->select('s.product, s.color, s.unit, sum(d.number) as number, sum(d.price) as price');
        $this->db->from('deposit d');
        $this->db->join('stock s', 'd.stock_id = s.id');
        if($stock_id != ''){
            $this->db->where('d.stock_id', $stock_id);
        }
        if($start_date != '' && $end_date != ''){
            $this->db->where('d.created_date BETWEEN "' . $start_date . '" AND "' . $end_date . '"');
        }
        else if($start_date != '' && $end_date == ''){
            $this->db->where('d.created_date >=', $start_date);
        }
        else if($start_date == '' && $end_date != ''){
            $this->db->where('d.created_date <=', $end_date);
        }
        $this->db->group_by('d.stock_id');
        $query = $this->db->get();
        return $query->result();
    }
}