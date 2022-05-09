<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $userModel = new UserModel();

        return $this->respondCreated([
            'status'  => 1,
            'data'    => $userModel->findAll(),
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $rules = [
			"firstname" => "required",
			"lastname"  => "required",
			"email"     => "required|valid_email|is_unique[users.email]",
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
        
            $userModel = new UserModel();
            $id = $this->request->getVar('id');
            $data = [
                'firstname' => $this->request->getVar('firstname'),
                'lastname'  => $this->request->getVar('lastname'),
                'email'     => $this->request->getVar('email'),
            ];
    
            $userModel->update($id, $data);

            return $this->respondCreated([
                'status'  => 1,
                'message' => "Update Successfully"
            ]);
        }
        
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $userModel = new UserModel();
        $userModel->delete(['id' => $id]);
        return $this->respondCreated([
            'status'  => 1,
            'message' => "Deleted Successfully"
        ]);
    }
}
