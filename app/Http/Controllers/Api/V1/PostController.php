<?php

namespace App\Http\Controllers\Api\V1;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class PostController
 * @package App\Http\Controllers\Api\V1
 */
class PostController extends Controller
{
    /**
     * get all posts
     * @return \Illuminate\Http\JsonResponse
     */
    public function posts()
    {
        $posts = Post::all ();

        return response ()->json (['posts'=>$posts,'status'=>200]);
    }

    /**
     * store post
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postStore(Request $request)
    {
        $post = Post::create ($request->all ());
        return response ()->json (['post'=>$post,'status'=>200]);
    }
}
