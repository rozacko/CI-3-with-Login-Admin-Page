<?php
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_users");
        $this->load->library('form_validation');
    }

    public function index()
    {
        // jika form login disubmit
        if($this->input->post()){
            if($this->M_users->doLogin()) redirect(site_url('admin'));
            else{
                ?>
                <script type="text/javascript">
                    alert("Sorry, your username or password is wrong, please try again!");
                </script>
                <?php
            }
        }

        // tampilkan halaman login
        $this->load->view("admin/login_page.php");
    }

    public function logout()
    {
        // hancurkan semua sesi
        $this->session->sess_destroy();
        redirect(site_url('admin/login'));
    }
}