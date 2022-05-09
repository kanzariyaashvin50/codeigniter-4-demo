<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class UsersController extends ResourceController
{
    
    protected $userModel = '';
    protected $db = '';

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();

    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        if ($this->request->isAJAX()) 
        {

            $start  = $this->request->getGet('start');
            $length = $this->request->getGet('length');
            $search_value = $this->request->getGet('search')['value'];

            if(!empty($search_value))
            {
                // count all data
                $total_count = $this->db->query("SELECT id,firstname,lastname,email,status from users WHERE firstname like '%".$search_value."%' OR lastname like '%".$search_value."%' OR email like '%".$search_value."%'")->getResult('array');

                $result = $this->db->query("SELECT id,firstname,lastname,email,status from users WHERE firstname like '%".$search_value."%' OR lastname like '%".$search_value."%' OR email like '%".$search_value."%' limit $start, $length")->getResult('array');
            }
            else
            {
                  $total_count = $this->db->query("SELECT id,firstname,lastname,email,status from users")->getResult('array');
                  $result = $this->db->query("SELECT id,firstname,lastname,email,status from users limit $start, $length")->getResult('array');
                  
            }

            $this->datatablesColumnOrder      = array(null,'firstname','lastname','email');
            $this->datatablesColumnSearch     = array('firstname','lastname','email');
            $this->datatablesOrder            = array('firstname' => 'asc');

            // $result = $this->userModel->fetchAll();

            $data          			  = array();
            $data['draw']  			  = $this->request->getGet('draw');
            $data['recordsFiltered']  = count($total_count);
            $data['recordsTotal']     = count($total_count);
            $data['data'] 			  = array();
            foreach ($result as $key => $value) 
            {
                $statusBtn  = '';
                $statusBtn .= '<a href="javascript:void(0)" class="status-btn btn '.(($value['status'] == 1) ? "btn-success" : "btn-warning").' " title="status" data-id="'.$value['status'].'">' .(($value["status"] == 1) ? "Active" : "Inactive") .'</a>';

                $actionBtn  = '';
                $actionBtn .= '<a href="javascript:void(0)" class="black mr-1 view-records" title="view" data-id="'.$value['id'].'" data-toggle="modal" data-target="#modal-lg-view"><i class="fa fa-eye" style="font-size: x-large;"></i></a>';
                $actionBtn .= '<a href="javascript:void(0)" class="black mr-1 edit-records" title="Edit" data-id="'.$value['id'].'" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-edit" style="font-size: x-large;"></i></a>';
                $actionBtn .= '<a href="javascript:void(0);" class="black mr-1 text-danger deleted-record" title="Remove" data-id="'.$value['id'].'"><i class="fa fa-trash" style="font-size: x-large;"></i></a>';
                
                $data['data'][] = array(
                    (!empty($value['firstname']) ? $value['firstname'] : 'N/A'),
                    (!empty($value['lastname']) ? $value['lastname'] : 'N/A'),
                    (!empty($value['email']) ? $value['email'] : 'N/A'),
                    $statusBtn,
                    $actionBtn
                );

            };

		return json_encode($data);
        }
        
        return view('users/index');
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        if ($this->request->isAJAX()) 
        {
            $id = $this->request->getGet('id');
            $model = new UserModel();
            $data = $model->select('id, firstname, lastname, email, status')->where('id', $id)->first();
            
            $response = [
                "status" => '1',
                'data'   => $data
            ];

            return $this->respondCreated([
                'status'  => 1,
                'data'    => $data
            ]);
        }
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
        if ($this->request->isAJAX()) 
        {
            $id = $this->request->getGet('id');
            $model = new UserModel();
            $data = $model->select('id, firstname, lastname, email, status')->where('id', $id)->first();
            
            $response = [
                "status" => '1',
                'data'   => $data
            ];

            return $this->respondCreated([
                'status'  => 1,
                'data'    => $data
            ]);
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        if ($this->request->isAJAX()) 
        {
            $userModel = new UserModel();

            $id = $this->request->getPost('updateId');
            $data = [
                'firstname' => $this->request->getPost('firstname'),
                'lastname'  => $this->request->getPost('lastname'),
                'email'     => $this->request->getPost('email'),
                'status'    => (!empty($this->request->getPost('is_active')) ? 1 : 0),
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
        if ($this->request->isAJAX()) 
        {
            $id = $this->request->getPost('id');
            $userModel = new UserModel();
            $userModel->delete(['id' => $id]);

            return $this->respondCreated([
                'status'  => 1,
                'message' => "Deleted Successfully"
            ]);
        }
        
    }
}
