<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ApiController extends BaseController
{
    use ResponseTrait;
    
    protected $userModel = '';  

    public function __construct()
    {
        // parent::__construct(); // BaseController has no Constructor

        $this->userModel = new UserModel();  
    }

    /**
     *  Authentication a user valid datails
     */
    public function login()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
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
            return $this->respondCreated([
                'status' => 500,
				'error' => true,
				'message' => $this->validator->getErrors(),
            ]);
        }
        else
        {
            // $userModel   = new UserModel();
            $email       = $this->request->getPost('email');
            $password    = $this->request->getPost('password');

            $email_exits = $this->userModel->findUserByEmailAddress($email);

            if($email_exits)
            {
                $verify_pass = password_verify($password, $email_exits['password']);

                if($verify_pass)
                {
                    // JWT Token Helper to get Token
                    $jwt = jwt_token($email_exits);

                    return $this->respondCreated([
                        'status'  => 1,
                        'jwt'     => $jwt,
                        'message' => "User Login successfully"
                    ]);
                }
                else
                {
                    return $this->respondCreated([
                        'status'  => 0,
                        'message' => "Invalid Email and Password"
                    ]);
                }
            }
            else
            {
                return $this->respondCreated([
                    'status'  => 0,
                    'message' => "User Not Found"
                ]);
            }
        }
    }

    /**
     * Register a new User
     */
    public function create()
    {
        $rules = [
			"firstname" => "required",
			"lastname"  => "required",
			"email"     => "required|valid_email|is_unique[users.email]",
			"password"  => "required",
		];

		$messages = [
			"firstname" => [
				"required" => "firstname is required"
			],
			"lastname" => [
				"required" => "lastname is required"
			],
			"email" => [
				"required" => "Email required",
				"valid_email" => "Email address is not in format",
				"is_unique" => "Email address already exists"
			],
			"password" => [
				"required" => "Password is required"
			],
		];
        if (!$this->validate($rules, $messages)) 
        {
            return $this->respondCreated([
                'status' => 500,
				'error' => true,
				'message' => $this->validator->getErrors(),
            ]);
        }
        else
        {

            // $userModel = new UserModel();
            $data = [
                'firstname' => $this->request->getPost('firstname'),
                'lastname'  => $this->request->getPost('lastname'),
                'email'     => $this->request->getPost('email'),
                'password'  => password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
            ];

            $result = $this->userModel->save($data);

            if($result)
            {
                return $this->respondCreated([
                    'status'  => 1,
                    'message' => "User Created Successfully"
                ]);
            }
            else
            {
                return $this->respondCreated([
                    'status'  => 0,
                    'message' => "Opps, Somthing want wrong!"
                ]);
            }
             
            return $this->respondCreated($data);
        }
    }

    public function getUser()
    {
        $request    = service('request');
        $key        = "examplesecurekey";
        $headers    = $request->getHeader('authorization');
        $jwt        = $headers->getValue();
        $userData   = JWT::decode($jwt, new Key($key, 'HS256'));
        
        if($userData)
        {
            return $this->respondCreated([
                'status'  => 200,
                'users'   => $userData->data
            ]);
        }
        else
        {
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ];
            return $this->respondCreated($response);
        }
       
    }
}
