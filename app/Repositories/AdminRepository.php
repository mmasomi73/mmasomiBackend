<?php
namespace App\Repositories;

use App\Admin;
use Hash;

class AdminRepository {

	private $admin;
	function __construct()
	{
		$this->admin = new Admin;
	}
	/**
	 * update only admin password information
	 * @param $request
	 * @param $admin
	 * @throws \Exception
	 */
	public function updateAdminPassword($request , $admin)
	{

		if($request->has('old_password')
		   &&  Hash::check($request->old_password,$admin->password)
		   && $request->has('new_password')
		   && !empty($request->new_password)
		) {
			$admin->password = bcrypt($request->new_password);
			$admin->save();
		}else{
			throw new \Exception("password is wrong");
		}
	}

	/**
	 * update Admin Info
	 * @param $request
	 * @param $admin
	 * @throws \Exception
	 */
	public function update($request , $admin)
	{
		$admin->name = $request->get('name');
		$admin->email = $request->get('email');
		$admin->save();
	}
}