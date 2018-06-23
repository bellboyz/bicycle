<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends CI_Controller {

	public function index(){
		$num = $this->Billing_model->getNumRows();
		$bill_id = $this->generate_Bill_ID($num + 1);

		$date = $this->get_format_date(date('d/m/Y'));

		$data = array(
			'bill_id' => $bill_id,
			'date' => $date,
			'customer' => $this->Customer_model->get_all_customer()
		);

		$this->load->view('billing', $data);
	}

	public function bill_detail(){
		// print_r($_POST);

		$bill_id = $this->input->post('bill_id');
		$date = $this->input->post('date');
		$cus_id = $this->input->post('cus_id');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		$result = $this->Deposit_model->get_deposit($cus_id, $start_date, $end_date);
		$customer = $this->Customer_model->get_customer($cus_id);

		for($i = 0; $i < sizeof($result); $i++){
			$result[$i]->created_date = $this->get_format_date($result[$i]->created_date);
		}

		$data = array(
			'bill_id' => $bill_id,
			'date' => $date,
			'customer' => $customer,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'deposit' => $result
		);

		$this->load->view('billing-detail', $data);
	}

	public function print_bill(){
		$bill_id = $this->input->post('bill_id');
		$date = $this->input->post('date');
		$cus_id = $this->input->post('cus_id');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$deposit = $this->input->post('deposit');

		$data = array(
			'bill_id' => $bill_id,
			'cus_id' => $cus_id,
			'created_date' => date('d/m/Y')
		);

		// $this->db->insert('billing', $data);

		print_r($deposit);
		
		// redirect('/billing');
	}

	private function generate_Bill_ID($num){
		$id = sprintf('B' . date('Ymd') . '%05d', $num);
		if($this->Billing_model->check_depID($id) == true){
			// duplicate
			$num = $num + 1;
			generate_Bill_ID($num);
		}
		else{
			return $id;
		}
	}

	private function get_format_date($data){
		$data = explode('/', $data);

		$year = $data[2];
		$month = $data[1];
		$date = $data[0];

	    if ($month == '01') $month = 'มกราคม';
	    else if ($month == '02') $month = 'กุมภาพันธ์';
	    else if ($month == '03') $month = 'มีนาคม';
	    else if ($month == '04') $month = 'เมษายน';
	    else if ($month == '05') $month = 'พฤษภาคม';
	    else if ($month == '06') $month = 'มิถุนายน';
	    else if ($month == '07') $month = 'กรกฎาคม';
	    else if ($month == '08') $month = 'สิงหาคม';
	    else if ($month == '09') $month = 'กันยายน';
	    else if ($month == '10') $month = 'ตุลาคม';
	    else if ($month == '11') $month = 'พฤศจิกายน';
	    else if ($month == '12') $month = 'ธันวาคม';
	    else $month = 'undefined';

	    return $date . ' ' . $month . ' ' . $year;
	}
}
