<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class LoginController extends BaseController
{
    
    public $session       = '';
    protected $adminModel = '';

    public function __construct()
    {
        // parent::__construct(); // BaseController has no Constructor

        $this->session    = session(); 
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $rules = [
			"email"     => "required|valid_email",
			"password"  => "required",
		];
		$messages = [
			"email" => [
				"required" => "Email required",
				"valid_email" => "Email address is not in format",
			],
			"password" => [
				"required" => "Password is required"
			],
		];

        if (!$this->validate($rules, $messages)) 
        {
            $this->session->setFlashdata('message',$this->validator->getErrors());
            return redirect()->back();
            // return redirect()->to('admin/login'); 
        }
        else
        {
            $email       = $this->request->getPost('email');
            $password    = $this->request->getPost('password');
            $email_exits = $this->adminModel->findUserByEmailAddress($email);

            if($email_exits)
            {
                $verify_pass = password_verify($password, $email_exits['password']);

                if($verify_pass)
                {
                    $session_data = [
                        'id'         => $email_exits['id'],
                        'firstname'  => $email_exits['firstname'],
                        'lastname'   => $email_exits['lastname'],
                        'email'      => $email_exits['email'],
                        'isLoggedIn' => TRUE
                    ];
                    $this->session->set($session_data);
                    return redirect()->to('admin/dashboard');
                }
                else
                {
                    $this->session->setFlashdata('error',"Invalid username and Password");
                    return redirect()->back();
                }
            }
            else
            {
                $this->session->setFlashdata('error',"User does not exist for specified email address");
                return redirect()->back();                
            }
        }
    }

    # Logout Admin
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('admin/login');
    }
}
