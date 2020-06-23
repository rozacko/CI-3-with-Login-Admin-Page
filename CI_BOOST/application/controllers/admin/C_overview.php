<?php

class C_overview extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model("M_users");
		if($this->M_users->isNotLogin()) redirect(site_url('admin/login'));
	}

	public function index()
	{
        // load view admin/overview.php
        $this->load->view("admin/overview");
	}
}