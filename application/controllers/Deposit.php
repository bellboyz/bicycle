<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller {

	public function index(){
		$num = $this->Deposit_model->getNumRows();
		$dep_id = $this->generate_depID($num + 1);

		$date = $this->get_format_date(date('d/m/Y'));

		$data = array(
			'dep_id' => $dep_id,
			'date' => $date,
			'stock' => $this->Stock_model->get_all_stock(),
			'customer' => $this->Customer_model->get_all_customer()

		);
		
		$this->load->view('deposit', $data);
	}

	public function add(){
		$dep_id = $this->input->post('dep_id');
		$cus_id = $this->input->post('cus_id');
		$stock_id = $this->input->post('stock_id');
		$number = $this->input->post('number');
		$price_per_number = $this->input->post('price_per_number');
		$price = $this->input->post('price');

		$location = $this->generate_pdf($dep_id, $cus_id, $stock_id, $number, $price_per_number, $price);

		for($i = 0; $i < sizeof($cus_id); $i++){
			$data = array(
				'dep_id' => $dep_id,
				'cus_id' => $cus_id[$i],
				'stock_id' => $stock_id[$i],
				'number' => $number[$i],
				'price_per_number' => $price_per_number[$i],
				'price' => $price[$i],
				'location' => $location,
				'created_date' => date('d/m/Y')
			);

			// if($this->db->insert('deposit', $data)){
			// 	$stock = $this->Stock_model->get_stock($stock_id[$i]);
			// 	$stock[0]->number -= $number[$i];

			// 	$update_stock = array(
			// 		'number' => $stock[0]->number
			// 	);

			// 	$this->Stock_model->update($stock_id[$i], $update_stock);

			// 	$result = true;
			// }
			// else{
			// 	$result = false;
			// }
		}

		if($result) echo true;
		else echo false;
	}

	private function generate_depID($num){
		$id = sprintf('D' . date('Ymd') . '%05d', $num);
		if($this->Deposit_model->check_depID($id) == true){
			// duplicate
			$num = $num + 1;
			generate_depID($num);
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

	private function generate_pdf($dep_id, $cus_id, $stock_id, $number, $price_per_number, $price){
		require_once getcwd() . '/common/plugins/mpdf1/mpdf.php';
		$mpdf = new mPDF('th', 'A4-L', 14, 'thsarabun', 10, 10, 7, 7, 9, 9); // font-set = th, paper-size = A4, font-size = 14, font = thsarabun, left = 10, right = 10, top = 7, bottom = 7

		for($i = 0; $i < sizeof($cus_id); $i++){
			$stock = $this->Stock_model->get_stock($stock_id[$i]);
			$html .= '<p>customer id = ' . $cus_id[$i] . '</p>';
			$html .= '<p>ss' . $stock[0]->product . '</p>';
			$html .= '<br>';
		}

		$mpdf->WriteHTML($html);
	    $mpdf->Output(getcwd() . '/common/file/deposit/'. $dep_id . '.pdf', 'F');
	    $location = 'common/file/' . $dep_id .'.pdf';
	    return $location;
	}
}
