<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
	public function index()
	{

		return view('admin.index.index');
	}


	public function profile() {
		return view('admin.profile.index');
	}

	public function update(UpdateAdminRequest $request) {
		try{
			(new AdminRepository)->update($request,auth('admin')->user());
		}catch(\Exception $e){
			return back()->with('error','خطا در ویرایش تغییرات');
		}
		return back()->with('success','ویرایش با موفقیت');
	}

	public function password(UpdatePasswordRequest $request) {
		try{
			(new AdminRepository)->updateAdminPassword($request,auth('admin')->user());
		}catch(\Exception $e){
			return back()->with('error','خطا در ویرایش تغییرات');
		}
		return back()->with('success','ویرایش با موفقیت');
	}
}
