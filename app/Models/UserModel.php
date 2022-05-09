<?php

namespace App\Models;
use CodeIgniter\Model;
use Exception;

/**
 * UserModel
 */
class UserModel extends Model
{
	protected $table         = 'users';
	protected $primaryKey    = 'id';
   	protected $allowedFields = ['firstname','lastname','email','status','password'];


	public function findUserByEmailAddress(string $emailAddress)
	{
		$user = $this
			->asArray()
			->where(['email' => $emailAddress])
			->first();

		if (!$user) 
			throw new Exception('User does not exist for specified email address');

		return $user;
	}

	public function fetchAll()
	{
		return $this->select('id, firstname, lastname, email, status')->findAll();
	}

}