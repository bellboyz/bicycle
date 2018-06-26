<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function index(){
		$data = array(
			'customer' => $this->Customer_model->get_all_customer(),
			'stock' => $this->Stock_model->get_all_stock()
		);
		$this->load->view('report', $data);
	}

	public function get(){
		$check = $this->input->post('check');
		$cus_id = $this->input->post('customer');
		$stock_id = $this->input->post('stock');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		if($check === 'report_stock'){
			$stock_add = $this->Stock_model->get_report_stock($stock_id, $start_date, $end_date);
			$data = array(
				'report' => 'stock',
				'stock' => $stock_add,
				'start_date' => $start_date,
				'end_date' => $end_date
			);

			$this->load->view('a4-template', $data);
		}
		else if($check === 'report_deposit'){
			$deposit = $this->Deposit_model->get_report_deposit($cus_id, $stock_id, $start_date, $end_date);
			$data = array(
				'report' => 'deposit',
				'deposit' => $deposit,
				'start_date' => $start_date,
				'end_date' => $end_date
			);
			
			$this->load->view('a4-template', $data);
		}
		else if($check === 'report_customer'){}
		else{}
	}
}
