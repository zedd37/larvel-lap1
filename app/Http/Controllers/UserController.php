<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct($name, $email)
    {
        $this->name= $name;
        $this->email = $email;
    }


    public function name($name=null)
    {
        if ($name) {
            $this->name=$name;
        }
        return $this->name;
    }

    public function email($email=null)
    {
        if ($email) {
            $this->email=$email;
        }
        return $this->email;
    }
}