<?php

namespace App\Repositories;

use App\Listen;
use App\Music;
use App\Utilities\FileManager;
use Carbon\Carbon;

class MusicRepository {

	private $music;

	function __construct() {
		$this->music = new Music();
	}

	public function getMusics( $paginate = 14 ) {
		$musics = Music::whereNotNull( 'src' )->with( 'listen' )->orderByDesc( 'created_at' )->paginate( $paginate );

		return $musics;
	}

	public function update( $music, $request ) {
		$music->title  = $request->get( 'title' );
		$music->artist = $request->get( 'artist' );
		if ( $request->hasFile( 'cover' ) ) {
			$cover_file   = FileManager::uploadCover( $request->file( 'cover' ) );
			$music->cover = $cover_file;
		}
		if ( $request->hasFile( 'music' ) ) {
			$music_file = FileManager::uploadMusic( $request->file( 'music' ) );
			$music->src = $music_file;
		}
		if ( ! empty( $request->get( 'music-link' ) ) ) {
			$music_file  = $request->get( 'music-link' );
			$music->link = 1;
		}
		if ( ! empty( $request->get( 'cover-link' ) ) ) {
			$cover_file  = $request->get( 'cover-link' );
			$music->link = 1;
		}
		$music->save();
	}

	public function delete( $music ) {

		if ( ! empty( $music->cover ) ) {
			FileManager::removeFile( $music->cover );
		}
		if ( ! empty( $music->src ) ) {
			FileManager::removeFile( $music->src );
		}
		$music->delete();
	}

	public function repost( $music ) {

		$music->created_at = Carbon::now();
		$music->save();
	}

	public function listen( $music ) {

		$l = Listen::where( 'music_id', $music->id )->first();
		if ( ! empty( $l ) ) {
			$l->listen = $l->listen + 1;
		} else {
			$l           = new Listen();
			$l->music_id = $music->id;
			$l->listen   = 1;
		}
		$l->save();
	}


	//--------------=
	public function getMusicsApi() {
		$musics  = Music::orderBy( 'created_at', 'DESC' )->get();
		$respons = [];
		foreach ( $musics as $music ) {
			$respons[] = [
				'id'     => $music->id,
				'src'    => $music->link == 0 ? url( '/' ) . $music->src : $music->src,
				'avatar' => $music->link == 0 ? url( '/' ) . $music->cover : $music->cover,
				'title'  => $music->title,
				'artist' => $music->artist,
			];
		}
		return $respons;
	}
}