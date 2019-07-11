@extends('admin.layouts.app')
@section('title') صفحه مدیریت آهنگ ها @endsection
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
                        <h4 class="m-b-10">صفحه مدیریت آهنگ ها</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.index')}}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">مدیریت آهنگ ها</a>
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
                                    <h5>افزودن آهنگ جدید</h5>
                                    <span class="header-action rot180"><i class="feather icon-chevron-down"></i></span>
                                </div>
                                <div class="card-block table-border-style" style="display: none;">
                                    <form action="{{route('admin.music.add')}}" method="post" class="form-material"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            {{-- Title --}}
                                            <div class="col-lg-4">
                                                <div class="form-group {{ $errors->has('title') ? 'form-danger' : 'form-primary' }}">
                                                    <input type="text" value="{{old('title')}}" class="form-control isf"
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
                                                    <input type="text" value="{{old('artist')}}"
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
                                                    <input type="text" value="{{old('music-link')}}"
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
                                                    <input type="text" value="{{old('cover-link')}}"
                                                           class="form-control isf ltr" name="cover-link"
                                                           id="cover-link">
                                                    <span class="form-bar"></span>
                                                    @if ($errors->has('cover-link'))
                                                        <span class="input-error">{{ $errors->first('cover-link') }}</span>
                                                    @endif
                                                    <label for="cover-link" class="float-label">لینک آواتار</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 offset-8">
                                                <button type="submit"
                                                        class="btn btn-info waves-effect waves-light w-100">ثبــــت
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Music Lists -->
                        <div class="col-lg-12 col-sm-12">
                            <div class="card rtl text-right st-card">
                                <div class="card-header">
                                    <span class="header-icon"><i class="feather icon-list full-card"></i></span>
                                    <h5>لیست آهنگ ها</h5>
                                    <span class="header-action"><i class="feather icon-chevron-down"></i></span>
                                </div>
                                <div class="card-block table-border-style">
                                    <ul class="ltr">
                                        @forelse($musics as $music)
                                            <li class="row ltr music-list">
                                                <div class="col-lg-10 pull-left text-left detail">
                                                    <div class="cover" style="background: url('{{$music->link == 0 ? '/'.$music->cover:$music->cover}}')">

                                                    </div>
                                                    <div class="artist">{{$music->artist}} </div>
                                                    <div class="title">{{$music->title}}</div>
                                                    <div class="time">{{$music->link == 0 ? mp3Duration($music->src) : '0:00'}}</div>
                                                    <div class="listen">{{!empty($music->listen)?$music->listen->listen:0}}</div>
                                                </div>
                                                <div class="col-lg-2 pull-left text-center" style="padding-top: 10px;">
                                                    <div class="play d-inline"
                                                         data-title="{{$music->title}}"
                                                         data-artist="{{$music->artist}}"
                                                         data-cover="{{$music->link == 0 ? '/'.$music->cover:$music->cover}}"
                                                         data-src="{{$music->link == 0 ? '/'.$music->src:$music->src}}">
                                                        <i title="Play" class="feather icon-play"></i>
                                                    </div>
                                                    <div class="edit d-inline">
                                                        <a href="{{route('admin.music.edit',$music->id)}}">
                                                            <i title="Edit" class="feather icon-edit"></i>
                                                        </a>
                                                    </div>
                                                    <div class="delete d-inline"
                                                         data-path="{{route ('admin.music.delete',$music->id)}}">
                                                        <i title="Delete" class="feather icon-trash"></i>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty

                                            <li class="row" style="">
                                                <div class="col-lg-12 text-center ltr">
                                                    Not Found Music!
                                                </div>
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                {{$musics->links('vendor.pagination.explor-pagination')}}
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
            const path = $(this).data('path');
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
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: path,
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "{{csrf_token ()}}",
                            id: id
                        }, beforeSend: function () {

                        }, success: function (data) {
                            if (data.id !== undefined) {
                                swal(
                                    'حذف شد!',
                                    'با موفقیت حذف شد.',
                                    'success'
                                ).then(function () {
                                    window.location.reload();
                                });
                            } else {
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

    </script>
@endsection