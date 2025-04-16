<!-- driver -->
<!-- set_value: https://codeigniter.com/userguide3/libraries/form_validation.html -->
<!-- helper  -->

<?php
defined('BASEPATH') or exit('No direct script access allowed');

// CI_Input
class UserController extends CI_Controller
{

    public $userModelObj;
    public $data;
    public $editUser;
    // public $CI;

    public function __construct()
    {
        parent::__construct();
        // $this->CI = $this->load->driver('CI_Input');
        // echo __LINE__. "<pre>"; var_dump($this->load->driver('CI_Controller')); exit;
        // $this->CI->post();
        // $this->load->helper('file');
        // $fileContent = file_get_contents( DIRPATH. '/views/Pages/UserHome.php');
        // $fileContent = get_dir_file_info( DIRPATH. '/models/UserModel.php');

        // $CI  = &get_instance();
        // $CI->load->model('UserModel');
        // $CI->load->driver('cache');
        // $CI->cache->memcached->get();
        // $this->load->helper('smiley');
        // $this->load->library('table');
// echo "fffffd";exit;
        // $image_array = get_clickable_smileys('localhost/codeigniter/index.php', 'question');
        // var_dump($image_array);
        $this->load->model('UserModel');
        $this->userModelObj = new userModel;
        $this->load->helper('url');
    }

    public function view()
    {
        $this->show();
        return $this->load->view('Pages/UserHome', [
            'data' => $this->data,
            'editUser' => $this->editUser
        ]);
        
        // $this->load->view('/Pages/UserHome', [$this->data, $this->editUser]);

        // $this->load->view('/Pages/UserHome', $this->data);
    }

    public function register()
    {
        if (isset($_POST['submit_btn'])) {
            // $this->input->post('fname');
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];

            $data = [
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
            ];

            // echo "<pre>"; var_dump($this->signupModelObj->is_user_exists($email));exit;
            if (!$this->userModelObj->is_user_exists($email)) {
                $inserted = $this->userModelObj->add($data);
                if ($inserted) {
                    echo " Your account has been created.";
                    redirect('UserController/view');
                } else {
                    echo "*ERROR: Account was not created.";
                }
            } else {

                echo " An account with this email already exists.";
            }
        } else {
            redirect('UserController/view');
        }
    }

    public function show()
    {
        $this->data =  $this->userModelObj->getData();
        return $this->data;
    }

    public function edit()
    {
        // $fname = $_POST['fname'];
        // $lname = $_POST['lname'];
        // $email = $_POST['email'];
        $id = $_POST['edit_btn'];
        $this->editUser = $this->userModelObj->editUser($id);
        if ($this->editUser) {
            // var_dump('Edit');
            // redirect('UserController/view');
            $this->view();
            // $_POST['submit_btn'];
        }

        // return $this->editUser;
    }

    public function update()
    {
        $id = $_POST['update_btn'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $this->userModelObj->updateUser($fname, $lname, $email, $id);
        $this->editUser = "";
        $this->view();
    }

    public function delete()
    {
        $id = $_POST['delete_btn'];
        $this->userModelObj->deleteUser($id);
        $this->view();
    }
}

$userControllerObj = new UserController();
