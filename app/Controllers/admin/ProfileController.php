<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class ProfileController extends BaseController
{

    protected $id = '';
    public function __construct()
    {
        // parent::__construct(); // BaseController has no Constructor
       $session   = session();
       $this->id  = $session->get('id');
    }

    public function index()
    {
    	$model   = new AdminModel();
        $data    = $model->select('id, firstname, lastname, email, profile_image')->where('id', $this->id)->first();
       return view('profile/index',$data);
    }

    public function updateProfile()
    {
    	$imageFile = $this->request->getFile('admin-profile');

        
        $imageFile->move(ROOTPATH . 'uploads/images');
        
        $adminModel   = new AdminModel();

        $data = [
            'profile_image' =>  'uploads/images/'.$imageFile->getClientName(),
        ];
        
        $adminModel->update($this->id, $data);

        return $this->respondCreated([
            'status'  => 1,
            'message' => "Update Successfully"
        ]);
    }
}
