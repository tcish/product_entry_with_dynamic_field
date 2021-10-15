<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function index(){
		$data["productName"] = $this->product_model->getProduct();
		$this->load->view('index', $data);
	}

	public function insertPage(){
		$this->product_model->insertProduct();
	}

	public function detailPage($id){
		$data["getPname"] = $this->product_model->getPname($id);
		$data["getProperty"] = $this->product_model->getProperty($id);
		$this->load->view("details", $data);
	}

	public function updatePage($id){
		$this->product_model->update($id);
	}

	public function delBeforeUpdate($id, $product_id){
		$this->product_model->delete($id, $product_id);
	}

	public function deleteProduct($id){
		$this->product_model->productDelete($id);
	}
}
