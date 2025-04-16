<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signup_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // DB is autoloaded or already loaded in controller
    }

    public function add($data)
    {
        return $this->db->insert('users', $data); // Assuming table name is 'users'
    }

    public function is_user_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function getData()
    {
        $data = $this->db->get('users');
        $row = $data->num_rows();
        $users = [];
        if ($row > 0) {
            foreach ($data->result() as $userData ) {
                $users[] = [
                    "id" => $userData->id,
                    "fname" => $userData->fname,
                    "lname" => $userData->lname,
                ];
            }
            // echo "<pre>"; var_dump($users); exit;
            return $users;
        }
    }
}
// $signupModelObj = new Signup_model();
// $signupModelObj->getData();
