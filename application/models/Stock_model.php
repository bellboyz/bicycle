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

    public function get_report_stock($stock_id, $start_date, $end_date){
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
        
        $this->db->select('s.id, s.product, s.color, s.unit, sum(a.number) as total_number');
        $this->db->from('stock s');
        $this->db->join('stock_add a', 's.id = a.stock_id');
        if($stock_id != ''){
            $this->db->where('a.stock_id', $stock_id);
        }
        if($start_date != '' && $end_date != ''){
            $this->db->where('a.created_date BETWEEN "' . $start_date . '" AND "' . $end_date . '"');
        }
        else if($start_date != '' && $end_date == ''){
            $this->db->where('a.created_date >=', $start_date);
        }
        else if($start_date == '' && $end_date != ''){
            $this->db->where('a.created_date <=', $end_date);
        }
        $this->db->group_by('a.stock_id');
        $query = $this->db->get();
        return $query->result();
    }
}