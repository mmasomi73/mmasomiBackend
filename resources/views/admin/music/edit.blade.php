@extends('admin.layouts.app')
@section('title') صفحه ویرایش آهنگ @endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/cms/assets/css/player-2.css">
    <link href="{{url('vendor')}}/sweet-alert/sweetalert2.min.css" rel="stylesheet" type="text/css">
@endsection
@section('breadcrumb')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h4 class="m-b-10">صفحه ویرایش آهنگ</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.index')}}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.music')}}">مدیریت آهنگ ها</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ویرایش آهنگ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('content')
    <div class="pcoded-inner-content rtl text-right">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <!-- [ page content ] start -->
                    <div class="row" style="margin-bottom: 70px;">
                        <!-- Import New Music -->
                        <div class="col-lg-12 col-sm-12">
                            <div class="card rtl text-right st-card">
                                <div class="card-header">
                                    <span class="header-icon"><i class="feather icon-music full-card"></i></span>
                                    <h5>ویرایش آهنگ</h5>
                                    <span class="header-action"><i class="feather icon-chevron-down"></i></span>
                                </div>
                                <div class="card-block table-border-style">
                                    <form action="{{route('admin.music.update',$music->id)}}" method="post" class="form-material"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            {{-- Title --}}
                                            <div class="col-lg-4">
                                                <div class="form-group {{ $errors->has('title') ? 'form-danger' : 'form-primary' }}">
                                                    <input type="text" value="{{old('title',$music->title)}}" class="form-control isf"
                                                           name="title" id="title">
                                                    <span class="form-bar"></span>
                                                    @if ($errors->has('title'))
                                                        <span class="input-error">{{ $errors->first('title') }}</span>
                                                    @endif
                                                    <label for="title" class="float-label">عنوان آهنگ</label>
                                                </div>
                                            </div>
                                            {{-- Artist --}}
                                            <div class="col-lg-4">
                                                <div class="form-group {{ $errors->has('artist') ? 'form-danger' : 'form-primary' }}">
                                                    <input type="text" value="{{old('artist',$music->artist)}}"
                                                           class="form-control isf" name="artist" id="artist">
                                                    <span class="form-bar"></span>
                                                    @if ($errors->has('artist'))
                                                        <span class="input-error">{{ $errors->first('artist') }}</span>
                                                    @endif
                                                    <label for="artist" class="float-label">خواننده</label>
                                                </div>
                                            </div>
                                            {{-- Cover --}}
                                            <div class="col-lg-4">
                                                <div class="form-group {{ $errors->has('cover') ? 'form-danger' : 'form-primary' }}">
                                                    <input type="file" class="form-control isf" name="cover" id="cover">
                                                    <span class="form-bar"></span>
                                                    @if ($errors->has('cover'))
                                                        <span class="input-error">{{ $errors->first('cover') }}</span>
                                                    @endif
                                                    <label for="cover" class="float-label">کاور</label>
                                                </div>
                                            </div>
                                            {{-- music --}}
                                            <div class="col-lg-8">
                                                <div class="form-group {{ $errors->has('music') ? 'form-danger' : 'form-primary' }}">
                                                    <input type="file" class="form-control isf" name="music" id="music">
                                                    <span class="form-bar"></span>
                                                    @if ($errors->has('music'))
                                                        <span class="input-error">{{ $errors->first('music') }}</span>
                                                    @endif
                                                    <label for="music" class="float-label">آهنگ</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group {{ $errors->has('music-link') ? 'form-danger' : 'form-primary' }}">
                                                    <input type="text" value="{{$music->link == 0 ? old('music-link',$music->music):old('music-link')}}"
                                                           class="form-control isf ltr" name="music-link"
                                                           id="music-link">
                                                    <span class="form-bar"></span>
                                                    @if ($errors->has('music-link'))
                                                        <span class="input-error">{{ $errors->first('music-link') }}</span>
                                                    @endif
                                                    <label for="music-link" class="float-label">لینک موزیک</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group {{ $errors->has('cover-link') ? 'form-danger' : 'form-primary' }}">
                                                    <input type="text" value="{{$music->link == 0 ?old('cover-link',$music->avatar):old('cover-link')}}"
                                                           class="form-control isf ltr" name="avatar-link"
                                                           id="avatar-link">
                                                    <span class="form-bar"></span>
                                                    @if ($errors->has('cover-link'))
                                                        <span class="input-error">{{ $errors->first('cover-link') }}</span>
                                                    @endif
                                                    <label for="cover-link" class="float-label">لینک آواتار</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <button type="submit"
                                                        class="btn btn-info waves-effect waves-light w-100">ثبــــت
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row ltr">
                                        <div class="col-lg-6 offset-lg-3">
                                            <div class="p-divider"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="ltr">
                                                <li class="row ltr music-edit">
                                                    <div class="col-lg-10 pull-left text-left detail">
                                                        <div class="cover"
                                                             style="background: url('{{$music->link == 0 ? '/'.$music->cover:$music->cover}}')">

                                                        </div>
                                                        <div class="info">

                                                            <div class="row m-t-20"  style="border-bottom: 1px solid #e2e2e270;margin: 20px 10px;">
                                                                <div class="col-lg-8">
                                                                    <span class="c-cyen">
                                                                        <i class="feather icon-user"></i>
                                                                    </span>
                                                                    {{$music->artist}}
                                                                </div>
                                                                <div class="col-lg-4" style="font-size: 12px;padding-top: 20px;">
                                                                    {{$music->link == 0 ? mp3Duration($music->src) : '0:00'}}

                                                                    <div class="play d-inline p-l-10 p-r-10 pointer p-right"
                                                                         data-title="{{$music->title}}"
                                                                         data-artist="{{$music->artist}}"
                                                                         data-cover="{{$music->link == 0 ? '/'.$music->cover:$music->cover}}"
                                                                         data-src="{{$music->link == 0 ? '/'.$music->src:$music->src}}">
                                                                        <i title="Play" class="feather icon-play"></i>
                                                                    </div>
                                                                    <div class="delete d-inline  p-l-10 p-r-10 pointer  p-right">
                                                                        <i title="Delete" class="feather icon-trash"></i>
                                                                    </div>
                                                                    <div class="repost d-inline  p-l-10 p-r-10 pointer  p-right">
                                                                        <i title="Repost" class="feather icon-corner-left-up"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row"  style="border-bottom: 1px solid #e2e2e270;margin: auto 10px;">
                                                                <div class="col-lg-8">
                                                                    <span class="c-cyen">
                                                                       <i class="feather icon-music"></i>
                                                                    </span>
                                                                    {{$music->title}}
                                                                </div>
                                                                <div class="col-lg-4" style="font-size: 12px;padding-top: 20px;">
                                                                    {{!empty($music->listen)?$music->listen:0}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="emb-player-box" id="ap">
                        <audio></audio>
                        <div class="em-player">
                            <div class="p-cover">

                            </div>
                            <div class="p-actions">
                                <div class="p-play">
                                    <i class="feather icon-play"></i>
                                </div>
                                <div class="p-prev">
                                    <i class="feather icon-rewind"></i>
                                </div>
                                <div class="p-next">
                                    <i class="feather icon-fast-forward"></i>
                                </div>
                                <div class="p-shuffle">
                                    <i class="feather icon-shuffle"></i>
                                </div>
                                <div class="p-repeat">
                                    <i class="feather icon-repeat"></i>
                                </div>
                            </div>
                            <div class="p-seekbar">
                                <div class="timer time_played">0:00</div>
                                <div class="timeline">
                                    <div class="line_preload"></div>
                                    <div class="line_played"></div>
                                </div>
                                <div class="total full_time">0:00</div>
                            </div>
                            <div class="p-info">
                                <div class="p-title"></div>
                                <div class="p-artist"></div>
                            </div>
                        </div>
                    </div>
                    <!-- [ page content ] end -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @include('admin.partials.notify')
    <script src="{{url('/vendor')}}/sweet-alert/sweetalert2.js"></script>
    <script src="{{url('/')}}/cms/assets/js/player/player.js"></script>
    <script>
        //-----= Delete
        $('.delete.d-inline').click(function () {
            const id = $(this).data('id');
            swal({
                title: 'آیا مطمئن هستید؟',
                text: "بعد از حذف امکان بازیابی وجود ندارد",
                type: 'warning',
                animation: false,
                customClass: 'animated tada',
                showCancelButton: true,
                confirmButtonColor: '#00bcd4',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله'
            }).then(function (result){
                if (result.value) {
                    $.ajax({
                        url: "{{route ('admin.music.delete',$music->id)}}",
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "{{csrf_token ()}}",
                            id: id
                        }, beforeSend: function () {

                        }, success: function (data) {
                            if(data.id !== undefined){
                                swal(
                                    'حذف شد!',
                                    'با موفقیت حذف شد.',
                                    'success'
                                ).then(function () {
                                    window.location = '{{route('admin.music')}}';
                                });
                            }else{
                                swal(
                                    'خطا در حذف!',
                                    'سیستم قادر به حذف نیست، مجدد سعی نمایید.',
                                    'danger'
                                )
                            }
                        }, complete: function (xhr, status) {
                            $('#owner-loading').fadeOut();
                        }, error: function (xhr, status, error) {
                        }
                    });
                }
            });
        });

        //-----= Repost
        $('.repost.d-inline').click(function () {
            const id = $(this).data('id');
            swal({
                title: 'آیا مطمئن هستید؟',
                text: "باز نشر باعث میشود آهنگ بالاتر دیده شود",
                type: 'warning',
                animation: false,
                customClass: 'animated tada',
                showCancelButton: true,
                confirmButtonColor: '#00bcd4',
                cancelButtonColor: '#8bc34a',
                confirmButtonText: 'بله'
            }).then(function (result){
                if (result.value) {
                    $.ajax({
                        url: "{{route ('admin.music.repost',$music->id)}}",
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "{{csrf_token ()}}",
                            id: id
                        }, beforeSend: function () {

                        }, success: function (data) {
                            if(data.id !== undefined){
                                swal(
                                    'باز پست شد!',
                                    'با موفقیت باز پست شد.',
                                    'success'
                                ).then(function () {
                                });
                            }else{
                                swal(
                                    'خطا در باز پست!',
                                    'سیستم قادر به باز پست نیست، مجدد سعی نمایید.',
                                    'danger'
                                )
                            }
                        }, complete: function (xhr, status) {
                            $('#owner-loading').fadeOut();
                        }, error: function (xhr, status, error) {
                        }
                    });
                }
            });
        });
    </script>
@endsection