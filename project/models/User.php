<?php

class UserModel extends Model
{
    public function register()
    {
        //Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $password = md5($post['password']);
        if ($post['submit']) {
            //insert into db
            $this->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            $this->bind(':name', $post['name']);
            $this->bind(':email', $post['email']);
            $this->bind(':password', $password);
            $this->execute();
            //verify
            if ($this->lastInsertId()) {
                //Redirect
                header('Location: ' . ROOT_URL . 'Users/login');
            }
        }
        return;
    }

    public function login(){
        //Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $password = md5($post['password']);
        if ($post['submit']) {
            // Compare Login
            $this->query('SELECT * FROM users WHERE email = :email AND password = :password');
            $this->bind(':email', $post['email']);
            $this->bind(':password', $password);
            $row = $this->single();
            if($row){
                echo 'Logged in';
            }
            else{
                echo 'Incorrect Login';
            }

        }
        return;
    }
}