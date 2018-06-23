<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function index(){
		$data = array(
			'customer' => $this->Customer_model->get_all_customer()
		);

		$this->load->view('search', $data);
	}

	public function get(){
		$cus_id = $this->input->post('cus_id');
		$check = $this->input->post('check');
		$id = $this->input->post('id');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		$data = array(
			'cus_id' => $cus_id,
			'check' => $check,
			'id' => $id,
			'start_date' => $start_date,
			'end_date' => $end_date
		);

		print_r($data);
	}
}
