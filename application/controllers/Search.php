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

		if($check == 'bill'){
			if($id){
				$customer = $this->Customer_model->get_customer($cus_id);

				$deposit = $this->Deposit_model->seart_deposit($id, $cus_id, $start_date, $end_date);

				for($i = 0; $i < sizeof($deposit); $i++){
					$deposit[$i]->created_date = $this->get_format_date($deposit[$i]->created_date);
				}

				$data = array(
					'bill_id' => $id,
					'customer' => $customer,
					'start_date' => $this->get_format_date($start_date),
					'end_date' => $this->get_format_date($end_date),
					'deposit' => $deposit,
					'search' => true
				);

				$this->load->view('billing-detail', $data);
			}
			else{}
		}
		else if($check == 'deposit'){
			//
		}
		else{}
	}

	private function get_format_date($data){
		if($data){
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
		else{
			return '';
		}
	}
}
