<?php
/**
 * Created by PhpStorm.
 * User: mma
 * Date: 5/7/2018
 * Time: 15:01
 */

namespace App\Repositories;


use App\Post;
use Illuminate\Http\Request;

class PostRepository
{
    private $model;
    public function __construct()
    {
        $this->model = new Post;
    }

    public function getLastPost($number = 5)
    {
        $this->model = $this->model->orderBy('published_at','DESC')->take($number)->get();
        return $this->model;
    }

    public function getByPaginate($paginate = 10)
    {
        $this->model = $this->model->orderBy('published_at','DESC')->paginate($paginate);
        return $this->model;
    }

    public function addPost(Request $request)
    {
        //TODO:: File Upload Handle
        $this->model->create($request->all ());
    }
}