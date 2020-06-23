<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_users");
        if($this->M_users->isNotLogin()) redirect(site_url('admin/login'));
        $this->load->model("M_product");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["C_product"] = $this->M_product->getAll();
        $this->load->view("admin/product/list", $data);
    }

    public function add()
    {
        $product = $this->M_product;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/product/new_form");
    }

    public function edit($id = null)
    {   
        // echo $id;
        if (!isset($id)) redirect('admin/C_product');
       
        $product = $this->M_product;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            echo "a";
            $product->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["product"] = $product->getById($id);
        if (!$data["product"]) show_404();
        
        $this->load->view("admin/product/edit_form", $data);
    }

    public function update($id = null){
        $product = $this->M_product;
        $product->update();
        $this->session->set_flashdata('success', 'Berhasil disimpan');
        redirect('admin/C_product');
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->M_product->delete($id)) {
            redirect(site_url('admin/C_product'));
        }
    }
}