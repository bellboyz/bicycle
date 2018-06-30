<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function __construct(){
        parent::__construct();
    }

	public function index(){
		$this->load->view('stock');
	}

	public function table(){
		// $this->load->library('datatables');
		// $this->module_model->db->set_dbprefix('');

		$sql = "
		id,
		product,
		color,
		number,
		unit,
		note
		";

		$this->datatables->select($sql, FALSE);

		$this->datatables->from('stock');

		$this->datatables->add_column('action', '
			<a class="btn btn-warning editAction" edit-id="$1">แก้ไข</a>
			<a class="btn btn-primary addStockAction" add-stock-id="$1">เพิ่มจำนวนสินค้า</a>
			<a class="btn btn-danger deleteAction" delete-id="$1" href="#">ลบ</a>', 'id');

		echo $this->datatables->generate();
	}

	public function add(){
		// print_r($_POST);

		$product = $this->input->post('product');
		$color = $this->input->post('color');
		// $number = $this->input->post('number');
		$unit = $this->input->post('unit');
		$note = $this->input->post('note');

		$insert_stock = array(
			'product' => $product,
			'color' => $color,
			// 'number' => $number,
			'unit' => $unit,
			'note' => $note
		);

		if($this->db->insert('stock', $insert_stock)){
			echo true;
		}
		else{
			echo false;
		}
	}

	public function delete(){
		$delete_id = $this->input->post('id');

		if($this->Stock_model->delete_stock($delete_id) == true){
			echo true;
		}
		else{
			echo false;
		}
	}

	public function edit(){
		$edit_id = $this->input->post('id');

		$data = $this->Stock_model->get_stock($edit_id);

		if($data){
			echo json_encode($data);
		}
		else{
			echo false;
		}
	}

	public function update(){
		$id = $this->input->post('id');
		$product = $this->input->post('product');
		$color = $this->input->post('color');
		// $number = $this->input->post('number');
		$unit = $this->input->post('unit');
		$note = $this->input->post('note');

		$edit_stock = array(
			'product' => $product,
			'color' => $color,
			// 'number' => $number,
			'unit' => $unit,
			'note' => $note
		);

		$this->Stock_model->update($id, $edit_stock);
	}

	public function add_number(){
		$id = $this->input->post('id');
		$number = $this->input->post('number');

		$data = array(
			'stock_id' => $id,
			'number' => $number,
			'created_date' => date('d/m/Y')
		);

		if($this->db->insert('stock_add', $data)){
			// echo true;
			$stock = $this->Stock_model->get_stock($id);
			$stock[0]->number += $number;

			$update_stock = array(
				'number' => $stock[0]->number
			);

			$this->Stock_model->update($id, $update_stock);
		}
		else{
			echo false;
		}
	}
}
