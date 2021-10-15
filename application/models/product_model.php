<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product_model extends CI_Model {
  public function checkPName(){
    $productName = $this->input->post("productName");

    $get = $this->db->where("name", $productName)->get('product');
    $name = $get->result_array();
    foreach ($name as $data) {
      return $data["name"];
    }
  }

  public function checkProperty($product_property){
    $get = $this->db->where("name", $product_property)->get('property');
    $propertyName = $get->result_array();
    foreach ($propertyName as $data) {
      return $data["name"];
    }
  }
  
  public function insertProduct(){
    $this->form_validation->set_rules("productName", "Product Name", "required|trim");

    if($this->form_validation->run() == FALSE) {
		  $this->load->view('addProduct');
    }else{
      $userData = array(
        "name" => $this->input->post("productName")
      );
      if ($this->checkPName() != $this->input->post("productName")) {
        $this->db->insert("product", $userData);
        $product_id = $this->db->insert_id();

        foreach ($this->input->post("pProperty") as $key => $value) {
          $pProperty = $this->input->post("pProperty")[$key];
  
          $userData = array(
            "name" => $pProperty
          );
          if ($pProperty == "") {
            // do nothing
          }elseif ($this->checkProperty($pProperty) == $pProperty) {
            $this->session->set_flashdata('propertyExist', '<script>alert("Property Already Inserted")</script>');
            redirect('Product/insertPage');
            die();
            
          }else{
            $this->db->insert("property", $userData);
            $property_id = $this->db->insert_id();

            $pValue = $this->input->post("pValue")[$key];
            $userData = array(
              "product_id" => $product_id,
              "property_id" => $property_id,
              "property_value" => $pValue
            );
            $this->db->insert("product_property", $userData);
          }
        }
        redirect('Product/');
        die();
      }else{
        $this->session->set_flashdata('msg', '<span style="color: red; font-weight: bold;">Product Already Exist</span>');
        $this->load->view("addProduct");
      }
    }
  }

  public function getProduct(){
    $get = $this->db->order_by("id", "desc")->get('product');
    return $get->result_array();
  }

  public function getPname($id){
    $get = $this->db->where("id", $id)->get('product');
    return $get->result_array();
  }

  public function getProperty($id){
    $get = $this->db->select('*')->from('product_property')->join('property', 'product_property.property_id = property.id')->where('product_property.product_id', $id)->get();
    return $get->result_array();
  }

  public function delete($id, $pId){
    $this->db->where("id", $id)->delete("property");
    $this->db->where("property_id", $id)->delete("product_property");
    redirect("Product/updatePage/".$pId);
    die();
  }

  public function checkPNameForUpdate(){
    $productName = $this->input->post("productName");

    $get = $this->db->where("name", $productName)->get('product');
    $name = $get->result_array();
    foreach ($name as $data) {
      return $data["id"];
    }
  }

  public function update($id){
    $this->form_validation->set_rules("productName", "Product Name", "required|trim");
 
    if($this->form_validation->run() == FALSE) {
      $data["updateFetch"] = $this->product_model->getPname($id);
      $data["property"] = $this->product_model->getProperty($id);
      $this->load->view('updatePage', $data);
    }else{
      $userData = array(
        "name" => $this->input->post("productName")
      );
      if ($this->checkPNameForUpdate() == $id || $this->checkPNameForUpdate() == "") {
        $this->db->where("id", $id)->update("product", $userData);
      }else {
        $this->session->set_flashdata('msg', '<span style="color: red; font-weight: bold;">Product Name Already Exist.</span>');
        redirect('Product/updatePage/'.$id);
        die();
      }

      foreach ($this->input->post("pProperty") as $key => $value) {
        $pProperty = $this->input->post("pProperty")[$key];
        $pValue = $this->input->post("pValue")[$key];
        $arr_id = $this->input->post("arr_id")[$key];

        if ($arr_id > 0) {
          $userData = array(
            "name" => $pProperty,
          );
          $this->db->where("id", $arr_id)->update("property", $userData);

          $userData = array(
            "property_value" => $pValue
          );
          $this->db->where("property_id", $arr_id)->update("product_property", $userData);
        }else{
          $userData = array(
            "name" => $pProperty
          );
          if ($pProperty == "") {
            $this->session->set_flashdata('propertyExist', '<script>alert("You Can Not Insert Empty Field")</script>');
            redirect('Product/updatePage/'.$id);
            die();
          }elseif ($this->checkProperty($pProperty) == $pProperty) {
            $this->session->set_flashdata('propertyExist', '<script>alert("Property Already Inserted")</script>');
            redirect('Product/updatePage/'.$id);
            die();
          }else {              
            $this->db->insert("property", $userData);
            $property_id = $this->db->insert_id();

            $userData = array(
              "product_id" => $id,
              "property_id" => $property_id,
              "property_value" => $pValue
            );
            $this->db->insert("product_property", $userData);
          }
        }
      }
      redirect('Product/');
      die();
    }
  }

  public function productDelete($id){
    $this->db->where("id", $id)->delete("product");

    $get = $this->db->where("product_id", $id)->get("product_property");
    $property = $get->result_array();
    foreach ($property as $data) {
      $property_id = $data["property_id"];
      $this->db->where("id", $property_id)->delete("property");
    }

    $this->db->where("product_id", $id)->delete("product_property");
    redirect("Product/");
    die();
  }
}