<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function index(){
		$data = array(
			'stock' => $this->Stock_model->get_all_stock()
		);
		$this->load->view('report', $data);
	}

	public function get(){
		$check = $this->input->post('check');
		$stock_id = $this->input->post('stock');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		if($check === 'report_stock'){
			$stock_add = $this->Stock_model->get_report_stock($stock_id, $start_date, $end_date);
		}
		else if($check === 'report_deposit'){}
		else if($check === 'report_customer'){}
		else{}
	}
}
