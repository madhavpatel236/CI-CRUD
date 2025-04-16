<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Signup_controller extends CI_Controller
{
    public $signupModelObj;
    public function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
        $CI->load->model('Signup_model');
        $this->signupModelObj = new Signup_model;
        $this->load->database('default', TRUE);
        $this->load->helper('url');
    }

    public function view()
    {
        $this->load->view('Pages/Signup');
    }

    public function register()
    {
        if (isset($_POST['submit_btn'])) {

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];

            $data = [
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
            ];

            // echo "<pre>"; var_dump($this->signupModelObj->is_user_exists($email));exit;
            if (!$this->signupModelObj->is_user_exists($email)) {
                $inserted = $this->signupModelObj->add($data);
                if ($inserted) {
                    echo " Your account has been created.";
                    redirect('signup_controller/view');
                } else {
                    echo "*ERROR: Account was not created.";
                }
            } else {
                echo " An account with this email already exists.";
            }
        } else {
            redirect('signup_controller/view');
        }
    }

    public function show()
    {
        return $this->signupModelObj->getData();
    }
}
