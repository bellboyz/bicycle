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
		$date = $this->input->post('date');

		$location = $this->generate_pdf($dep_id, $cus_id, $stock_id, $number, $price_per_number, $price, $date);

		for($i = 0; $i < sizeof($cus_id); $i++){
			$data = array(
				'dep_id' => $dep_id,
				'cus_id' => $cus_id[$i],
				'stock_id' => $stock_id[$i],
				'number' => $number[$i],
				'price_per_number' => $price_per_number[$i],
				'price' => $price[$i],
				'location' => $location,
				'created_date' => date('Y-m-d')
			);

			if($this->db->insert('deposit', $data)){
				$stock = $this->Stock_model->get_stock($stock_id[$i]);
				$stock[0]->number -= $number[$i];

				$update_stock = array(
					'number' => $stock[0]->number
				);

				$this->Stock_model->update($stock_id[$i], $update_stock);

				$result = true;
			}
			else{
				$result = false;
			}
		}

		if($result) echo $location;
		else echo false;
	}

	private function generate_depID($num){
		$id = sprintf('D' . date('Ymd') . '%03d', $num);
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

	private function generate_pdf($dep_id, $cus_id, $stock_id, $number, $price_per_number, $price, $date){
		require_once getcwd() . '/common/plugins/mpdf1/mpdf.php';
		$mpdf = new mPDF('th', 'A4-L', 16, 'thsarabun', 15, 15, 10, 10, 9, 9); // font-set = th, paper-size = A4-L, font-size = 12, font = thsarabun, left = 10, right = 10, top = 7, bottom = 7

		$customer = $this->Customer_model->get_customer($cus_id[0]);
		$total1 = 0;
		$total2 = 0;

		$date = explode(' ', $date);
		$year = $date[2] + 543;
		$date = $date[0] . ' ' . $date[1] . ' ' . $year;

		$html = '';

	    $html .= '
	    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	    <html xmlns="http://www.w3.org/1999/xhtml">
	    <head>
	    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
	    <meta charset="utf-8"/>
	    <style>
	    /* Split the screen in half */
	    .split {
	    	height: 95%;
	    	width: 48%;
	    	position: fixed;
	    	z-index: 1;
	    	top: 0;
	    	overflow-x: hidden;
	    	padding-top: 20px;
	    	// border: solid 1px;
	    	
	    }

	    /* Control the left side */
	    .left {
	    	left: 0;
	    }

	    /* Control the right side */
	    .right {
	    	right: 0;
	    }

	    .col-md-12 {
	    	width: 100%
	    }

	    .col-md-8 {
			width: 66.66666667%;
	    }

	    .col-md-4 {
			width: 33.33333333%;
	    }

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

	    </style>
	    </head>
	    <body>
	    ';

	    $html .= '
	    <div class="split left">
	    	<div style="height: 75%;">
		    	<table>
					<tbody>
						<tr>
							<td rowspan="2"></td>
							<td><center>เลขที่</center></td>
						</tr>
						<tr>
							<td style="width: 30%;"><center>' . $dep_id . '</center></td>
						</tr>
					</tbody>
				</table>

				<table>
					<tbody>
						<tr>
							<td><center>ใบรับฝากสินค้า</center></td>
						</tr>
					</tbody>
				</table>

				<table>
					<tbody>
						<tr>
							<td style="width: 10%; border: 0px;">นาม : </td>
							<td style="width: 40%; border: 0px;">' . $customer[0]->name . '</td>
							<td style="width: 10%; border: 0px;">วันที่ : </td>
							<td style="width: 20%; border: 0px;">' . $date . '</td>
						</tr>
						<tr>
							<td style="border: 0px;">ที่อยู่</td>
							<td colspan="3" style="border: 0px;">' . $customer[0]->address . '</td>
						</tr>
					</tbody>
				</table>

				<table>
					<thead>
						<tr>
							<th><center>ลำดับ</center></th>
							<th><center>สินค้า</center></th>
							<th><center>หน่วยละ</center></th>
							<th><center>จำนวน</center></th>
							<th><center>จำนวนเงิน</center></th>
						</tr>
					</thead>
					<tbody>';
						for($i = 0; $i < sizeof($stock_id); $i++){
							$stock = $this->Stock_model->get_stock($stock_id[$i]);
							$order = $i + 1;
							$html .= '<tr>';
							$html .= '<td><center>' . $order . '</center></td>';
							$html .= '<td><center>' . $stock[0]->product . ' สี' . $stock[0]->color . '</center></td>';
							$html .= '<td><center>' . number_format($price_per_number[$i]) . '</center></td>';
							$html .= '<td><center>' . $number[$i] . ' ' . $stock[0]->unit . '</center></td>';
							$html .= '<td><center>' . number_format($price[$i]) . '</center></td>';
							$html .= '</tr>';
							$total1 += $price[$i];
						}
		$html .= '					
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
			<div style="height: 20%;">
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
							<td style="width: 20%; border: 0px;">สถานที่จัดส่ง : </td>
							<td></td>
						</tr>
					</tbody>
				</table>

				<table>
					<tbody>
						<tr>
							<td style="width: 60%; border: 0px;"></td>
							<td style="width: 15%;border: 0px;">ผู้รับของ : </td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
	    </div>

	    <div class="split right">
	    	<div style="height: 75%;">
		    	<table>
					<tbody>
						<tr>
							<td rowspan="2"></td>
							<td><center>เลขที่</center></td>
						</tr>
						<tr>
							<td style="width: 30%;"><center>' . $dep_id . '</center></td>
						</tr>
					</tbody>
				</table>

				<table>
					<tbody>
						<tr>
							<td><center>ใบรับฝากสินค้า (สำเนา)</center></td>
						</tr>
					</tbody>
				</table>

				<table>
					<tbody>
						<tr>
							<td style="width: 10%; border: 0px;">นาม : </td>
							<td style="width: 40%; border: 0px;">' . $customer[0]->name . '</td>
							<td style="width: 10%; border: 0px;">วันที่ : </td>
							<td style="width: 20%; border: 0px;">' . $date . '</td>
						</tr>
						<tr>
							<td style="border: 0px;">ที่อยู่</td>
							<td colspan="3" style="border: 0px;">' . $customer[0]->address . '</td>
						</tr>
					</tbody>
				</table>

				<table>
					<thead>
						<tr>
							<th><center>ลำดับ</center></th>
							<th><center>สินค้า</center></th>
							<th><center>หน่วยละ</center></th>
							<th><center>จำนวน</center></th>
							<th><center>จำนวนเงิน</center></th>
						</tr>
					</thead>
					<tbody>';
					for($i = 0; $i < sizeof($stock_id); $i++){
						$stock = $this->Stock_model->get_stock($stock_id[$i]);
						$order = $i + 1;
						$html .= '<tr>';
						$html .= '<td><center>' . $order . '</center></td>';
						$html .= '<td><center>' . $stock[0]->product . ' สี' . $stock[0]->color . '</center></td>';
						$html .= '<td><center>' . number_format($price_per_number[$i]) . '</center></td>';
						$html .= '<td><center>' . $number[$i] . ' ' . $stock[0]->unit . '</center></td>';
						$html .= '<td><center>' . number_format($price[$i]) . '</center></td>';
						$html .= '</tr>';
						$total2 += $price[$i];
					}
		$html .= '
					</tbody>
				</table>

				<table>
					<tbody>
						<tr>
							<td style="width: 50%; border: 0px"></td>
							<td style="border: 0px;">รวมเงิน</td>
							<td style="border: 0px;"><center>' . number_format($total2) . '</center></td>
							<td style="border: 0px;">บาท</td>
						</tr>
					</tbody>
				</table>

			</div>
			<div style="height: 20%;">
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
							<td style="width: 20%; border: 0px;">สถานที่จัดส่ง : </td>
							<td></td>
						</tr>
					</tbody>
				</table>

				<table>
					<tbody>
						<tr>
							<td style="width: 60%; border: 0px;"></td>
							<td style="width: 15%;border: 0px;">ผู้รับของ : </td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
	    </div>
	    ';

		$mpdf->WriteHTML($html);
	    $mpdf->Output(getcwd() . '/common/file/deposit/'. $dep_id . '.pdf', 'F');
	    $location = 'common/file/deposit/' . $dep_id .'.pdf';
	    return $location;
	}
}
