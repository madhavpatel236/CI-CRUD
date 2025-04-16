<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    // public $test;

    public function __construct()
    {
        parent::__construct();
        // echo __LINE__; "<pre>"; var_dump($this->input); exit;
    }
    public function add($data)
    {
        return $this->db->insert('users', $data); 
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
            foreach ($data->result() as $userData) {
                $users[] = [
                    "fname" => $userData->fname,
                    "lname" => $userData->lname,
                    "email" => $userData->email,
                    "Id" => $userData->id
                ];
            }
            // echo "<pre>"; var_dump($users); exit;
            return $users;
        }
    }

    public function editUser($id)
    {
        $this->db->where(['id' => $id]);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function updateUser($fname, $lname, $email, $id)
    {
        $user = $this->db->get_where('users', ['id' => $id]);
        if($user->num_rows() > 0){
            $this->db->set('fname', $fname);
            $this->db->set('lname', $lname);
            $this->db->set('email', $email);
            $this->db->where(['id' => $id]);
            $this->db->update('users');
        }
    }

    public function deleteUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }
}
