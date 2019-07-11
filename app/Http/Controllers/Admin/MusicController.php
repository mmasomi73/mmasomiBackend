<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Music\UpdateMusicRequest;
use App\Music;
use App\Utilities\FileManager;
use App\Http\Controllers\Controller;
use App\Repositories\MusicRepository;
use App\Http\Requests\Admin\Music\CreateMusicRequest;

class MusicController extends Controller
{
	public function index() {
		$musics = (new MusicRepository)->getMusics();
		return view('admin.music.index',compact('musics'));
    }

	public function create(CreateMusicRequest $request) {
		try{
			$music = new Music();
			if (!empty($request->get('music'))){
				$music_file = FileManager::uploadMusic($request->file('music'));
			}else{
				$music_file = $request->get('music-link');
				$music->link = 1;
			}
			if ( !empty($request->get('cover'))){
				$cover_file = FileManager::uploadCover($request->file('cover'));
			}else{
				$cover_file = $request->get('cover-link');
				$music->link = 1;
			}
			$music->src = $music_file;
			$music->cover = $cover_file;
			$music->title = $request->get('title');
			$music->artist = $request->get('artist');
			$music->save();
		}catch(\Exception $e){
			return back()->with('error','خطا در ثبت آهنگ');
		}
		return back()->with('success','آهنگ با موفقیت ثبت شد.');

    }

	public function edit(Music $music) {
		$music->load('listen');
		return view('admin.music.edit',compact('music'));
	}

	public function update(Music $music,UpdateMusicRequest $request) {
		try{
			(new MusicRepository)->update($music,$request);
		}catch(\Exception $e){
			return back()->with('error','خطا در ثبت آهنگ');
		}
		return back()->with('success','آهنگ با موفقیت ثبت شد.');
	}

	public function delete(Music $music) {
		try{
			(new MusicRepository)->delete($music);
		}catch(\Exception $e){
			return [
				"error"=>true,
			];
		}
		return [
			"id"=>true,
		];
	}

	public function repost(Music $music) {
		try{
			(new MusicRepository)->repost($music);
		}catch(\Exception $e){
			return [
				"error"=>true,
				'msg'=>$e->getMessage()
			];
		}
		return [
			"id"=>true,
		];
	}
}
