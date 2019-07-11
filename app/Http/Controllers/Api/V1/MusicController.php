<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\MusicRepository;

/**
 * Class MusicController
 * @package App\Http\Controllers\Api\V1
 */
class MusicController extends Controller
{

    public function musics()
    {
		$musics = (new MusicRepository())->getMusicsApi();
        return response (['musics'=>$musics,'status'=>200],200);
    }

}
