<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct(){
        parent::__construct();
    }

	public function index(){
		$this->load->view('customer');
	}

	public function table(){
		// $this->load->library('datatables');
		// $this->module_model->db->set_dbprefix('');

		$sql = "
		id,
		name,
		address,
		tel
		";

		$this->datatables->select($sql, FALSE);

		$this->datatables->from('customer');

		$this->datatables->add_column('action', '
			<a class="btn btn-warning editAction" edit-id="$1">แก้ไข</a>
			<a class="btn btn-danger deleteAction" delete-id="$1" href="#">ลบ</a>', 'id');

		echo $this->datatables->generate();
	}

	public function add(){
		// print_r($_POST);

		$name = $this->input->post('name');
		$address = $this->input->post('address');
		$tel = $this->input->post('tel');

		$insert_customer = array(
			'name' => $name,
			'address' => $address,
			'tel' => $tel
		);

		if($this->db->insert('customer', $insert_customer)){
			echo true;
		}
		else{
			echo false;
		}
	}

	public function delete(){
		$delete_id = $this->input->post('id');

		if($this->Customer_model->delete_customer($delete_id) == true){
			echo true;
		}
		else{
			echo false;
		}
	}

	public function edit(){
		$edit_id = $this->input->post('id');

		$data = $this->Customer_model->get_customer($edit_id);

		if($data){
			echo json_encode($data);
		}
		else{
			echo false;
		}
	}

	public function update(){
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$address = $this->input->post('address');
		$tel = $this->input->post('tel');

		$edit_customer = array(
			'name' => $name,
			'address' => $address,
			'tel' => $tel
		);

		$this->Customer_model->update($id, $edit_customer);
	}

	public function check_name(){
		$name = $this->input->post('name');
		$check = $this->Customer_model->check_name($name);
		if($check === true) echo json_encode(array('valid' => TRUE));
		else echo json_encode(array('valid' => FALSE));
	}
}
