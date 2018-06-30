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
			'deposit' => $result,
			'search' => false
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

		$location = $this->generate_pdf();

		// $data = array(
		// 	'bill_id' => $bill_id,
		// 	'cus_id' => $cus_id,
		// 	'location' => $location,
		// 	'created_date' => date('d/m/Y')
		// );

		// $this->db->insert('billing', $data);

		// $deposit = explode(',', $deposit);

		// for($i = 0; $i < sizeof($deposit); $i++){
		// 	$update_bill = array(
		// 		'bill_id' => $bill_id
		// 	);
		// 	$this->Deposit_model->update_bill($deposit[$i], $update_bill);
		// }
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

	private function generate_pdf($dep_id, $cus_id, $stock_id, $number, $price_per_number, $price){
		require_once getcwd() . '/common/plugins/mpdf1/mpdf.php';
		$mpdf = new mPDF('th', 'A4-L', 14, 'thsarabun', 10, 10, 7, 7, 9, 9); // font-set = th, paper-size = A4-L, font-size = 12, font = thsarabun, left = 10, right = 10, top = 7, bottom = 7

		// $customer = $this->Customer_model->get_customer($cus_id[0]);
		$total = 0;

		$html = '';

		$html .= '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
			<meta charset="utf-8"/>
			<style>

				table {
					border-collapse: collapse;
					width: 100%;
				}

				table td, table th {
					border: 1px solid #ddd;
					padding: 8px;
				}

				table th {
					padding-top: 12px;
					padding-bottom: 12px;
				}
				#non-border td, non-border th {
				border: none;
			}
			</style>
		</head>
		<body>
		';

		$html .= '
			<div style="height: 80%;">
				<table id="non-border">
					<tr>
						<td rowspan="2" style="width: 70%;">รุ่งกิจ จักรยาน จำกัด</td>
						<td rowspan="1"></td>
						<td rowspan="3" style="font-size: 26px;"><center><b>เลขที่ใบวางบิล</b></center></td>
					</tr>
					<tr>
						<td rowspan="1"></td>
					</tr>
					<tr>
						<td rowspan="2">363 สุขสวัสดิ์ 26 แยก 8 แขวงบางปะกอก เขตราษฏร์บูรณะ</td>
						<td rowspan="1"></td>
					</tr>
					<tr>
						<td rowspan="1"></td>
						<td rowspan="3" style="font-size: 26px;"><center><b>B25610418001</b></center></td>
					</tr>
					<tr>
						<td rowspan="2">กรุงเทพมหานคร 10140</td>
						<td rowspan="1"></td>
					</tr>
					<tr>
						<td rowspan="1"></td>
					</tr>
				</table>

				<table>
					<tbody>
						<tr>
							<td style="width: 10%; border: 0px;">นาม : </td>
							<td style="width: 60%; border: 0px;">asd</td>
							<td style="width: 10%; border: 0px;">วันที่ : </td>
							<td style="width: 20%; border: 0px;">15 มกราคม 2561</td>
						</tr>
						<tr>
							<td style="border: 0px;">ที่อยู่</td>
							<td colspan="3" style="border: 0px;">ddddddddddddddddddddd</td>
						</tr>
					</tbody>
				</table>

				<table>
					<thead>
						<tr>
							<th><center>ลำดับ</center></th>
							<th><center>เลขที่ใบฝากสินค้า</center></th>
							<th><center>วันที่ใบฝากสินค้า</center></th>
							<th><center>ราคา</center></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1<center>
							<td>DDDDDDDDDDDDDDD<center>
							<td>123123123<center>
							<td>123123<center>
						</tr>
					</tbody>
				</table>

				<table>
					<tbody>
						<tr>
							<td style="width: 50%; border: 0px"></td>
							<td style="border: 0px;">รวมเงิน</td>
							<td style="border: 0px;"><center>' . number_format($total1) . '</center></td>
							<td style="border: 0px;">บาท</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div style="height: 15%;">
				<table>
					<tbody>
						<tr>
							<td style="width: 20%; border: 0px;">หมายเหตุ : </td>
							<td></td>
						</tr>
					</tbody>
				</table>

				<table>
					<tbody>
						<tr>
							<td style="width: 80%; border: 0px;"></td>
							<td style="width: 15%; border: 0px;">ผู้รับของ</td>
						</tr>
						<tr>
							<td style="border: 0px;"></td>
							<td style="border: 0px;"></td>
						</tr>
						<tr>
							<td style="border: 0px;"></td>
							<td style="border: 0px;">วันที่.......................................................</td>
						</tr>
					</tbody>
				</table>
			</div>
		</body>
			';

		$mpdf->WriteHTML($html);
		$mpdf->Output(getcwd() . '/common/file/bill/'. $dep_id . '.pdf', 'F');
		$location = 'common/file/bill/' . $dep_id .'.pdf';
		return $location;
	}
}
