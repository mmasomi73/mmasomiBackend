<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     |---------------------------------------------
     | index Of Post Page
     |---------------------------------------------
     | @return view
     */
    public function index(PostRepository $repository)
    {
        $posts = $repository->getByPaginate (10);
        return view ('admin.post.index',compact ('posts'));
    }
    public function add(Request $request,PostRepository $repository)
    {
        $repository->addPost($request);
        return back ()->with ('message','Success');
    }
    public function edit()
    {

    }
    public function update()
    {

    }public function delete()
    {

    }
}
