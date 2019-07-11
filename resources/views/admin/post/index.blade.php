@extends('admin.layouts.app')
@section('title') صفحه مدیریت پست ها @endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/cms/assets/css/player-2.css">
    <link href="{{url('vendor')}}/sweet-alert/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <style>
        .table.table-xs td, .table.table-xs th {
            padding: 0.4rem 1rem;
        }
        .card-header{
            overflow: hidden;
        }
        .card-header .st-icon {
            color: #fff;
            font-size: 23px;
            padding: 40px 40px 20px 20px;
            border-radius: 50%;
            position: absolute;
            top: -30px;
            right: -30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
        }
        .card-header:hover .st-icon {
            font-size: 40px;
        }
        .bg-c-pink{
            background: #ef1b66;
        }
        .upload-form{
            width: 100%;
            height: 100%;
            border: 1px solid #e2e2e2;
            border-radius: 0.25rem;
            cursor: pointer;
            overflow: hidden;
        }
        .upload-form input[type="file"]{
            display: none;
            opacity: 0;
            z-index: -999;
        }
        .upload-title{
            width: 100%;
            height: 100%;
            text-align: center;
            vertical-align: middle;
            color: #fff;
            font-weight: 700;
            font-size: 2rem;
            background: #5f9ea0a1;
            padding: 5%;
        }
        .table tr:hover{
            background: rgba(241, 241, 241, 0.62);
            cursor: pointer;
        ;
        }
    </style>
@endsection
@section('breadcrumb')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h4 class="m-b-10">صفحه مدیریت پست ها</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.index')}}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">مدیریت پست ها</a>
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
                    <div class="row">

                        <!-- Add Post start -->
                        <div class="col-lg-12 col-sm-12">
                            <div class="card rtl text-right st-card">
                                <div class="card-header">
                                    <span class="header-icon"><i class="feather icon-music full-card"></i></span>
                                    <h5>Add New Post</h5>
                                    <span class="header-action"><i class="feather icon-chevron-down"></i></span>
                                </div>
                                <div class="card-block table-border-style">
                                    <form action="{{route ('admin.posts.add')}}" method="post" class="form-material">
                                        {{csrf_field ()}}
                                        <div class="row">
                                            <div class="col-lg-12 p-20">
                                                <div class="upload-form" style="min-height: 150px;background: url('{{url('bundles/cms')}}/assets/images/slider/slide2.jpg');background-size: cover;background-position: center;">
                                                    <input type="file" name="cover">
                                                    <div class="upload-title">Cover Image</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-sm-12">
                                                <div class="col-lg-12">
                                                    <div class="form-group form-primary">
                                                        <input type="text" id="title" name="title" class="form-control" required="">
                                                        <span class="form-bar"></span>
                                                        <label for="title" class="float-label">Title</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group form-primary">
                                                        <textarea name="post" id="post" class="form-control" cols="30" rows="20"></textarea>
                                                        <span class="form-bar"></span>
                                                        <label for="post" class="float-label">Post</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group form-primary">
                                                        <textarea name="back_post" id="back_post" class="form-control" cols="30" rows="30"></textarea>
                                                        <span class="form-bar"></span>
                                                        <label for="back_post" class="float-label">Back Post</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-12 p-t-20 p-b-20">
                                                <div class="upload-form" style="background: url('{{url('bundles/cms')}}/assets/images/slider/slider6.jpg');background-size: cover;background-position: center;">
                                                    <input type="file" name="thumb">
                                                    <div class="upload-title">Thumbnail</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <button style="width: 100%;" type="submit" class="m-l-10 btn btn-primary btn-sm waves-effect waves-light">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Add Post   end -->

                        <!-- Manage Post start -->
                        <div class="col-lg-12 col-sm-12">
                            <div class="card rtl text-right st-card">
                                <div class="card-header">
                                    <span class="header-icon"><i class="feather icon-music full-card"></i></span>
                                    <h5>Posts</h5>
                                    <span class="header-action"><i class="feather icon-chevron-down"></i></span>
                                </div>
                                <div class="card-block table-border-style">
                                    <div class="row m-b-10">
                                        <div class="col-lg-12">
                                            <form action="" class="form-material">
                                                <div class="row">
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="form-group form-primary">
                                                            <input type="text" name="footer-email" class="form-control" required="">
                                                            <span class="form-bar"></span>
                                                            <label class="float-label">Title</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="form-group form-primary">
                                                            <input type="text" name="footer-email" class="form-control" required="">
                                                            <span class="form-bar"></span>
                                                            <label class="float-label">Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="form-group form-primary">
                                                            <input type="text" name="footer-email" class="form-control" required="">
                                                            <span class="form-bar"></span>
                                                            <label class="float-label">Message</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="form-group form-primary">
                                                            <input type="text" name="footer-email" class="form-control" required="">
                                                            <span class="form-bar"></span>
                                                            <label class="float-label">Author Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 pull-right">
                                                        <button style="width: 100%;" class="btn btn-sm btn-primary waves-effect waves-light">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-xs  rtl text-right">
                                            <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Message</th>
                                                <th>Author</th>
                                                <th>Date</th>
                                                <th>Opt</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $i = 0; @endphp
                                            @forelse($posts as $post)
                                                <tr>
                                                    <th class="isf" scope="row">{{++$i}}</th>
                                                    <td>
                                                        <div style="max-width: 230px;" class="isf truncate col-lg-4">
                                                            {{$post->title}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="max-width: 230px;" class="isf truncate">
                                                            {{$post->post}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a class="text-center" href="#">mma</a>
                                                    </td>
                                                    <td class="isf">
                                                        <div style="font-size: 10px;text-align: center;">
                                                            <div>{{getPostTime($post->published_at)}}</div>
                                                            <div>{{getPostDate($post->published_at)}}</div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="">
                                                            <button class="btn waves-effect waves-light btn-inverse btn-mini"><i class="feather icon-user m-0"></i></button>
                                                            <button class="btn waves-effect waves-light btn-info btn-mini"><i class="feather icon-edit  m-0"></i></button>
                                                            <button class="btn waves-effect waves-light btn-danger btn-mini"><i class="feather icon-trash  m-0"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="ltr text-center" colspan="6">No Post Submit Yet.</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                        {{$posts->links('vendor.pagination.explor-pagination')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Manage Post   end -->
                    </div>
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
        $('body').ready(function () {
            $('.truncate').each(function () {
                var text = $(this).text();
                var trunked = text = text.trim();
                trunked = text = trunked.replace(/\n/g,' ');
                trunked = trunked.substring(30, 0);
                if(text.length > 30)trunked += '...';
                $(this).text(trunked);
            });
        });
    </script>
@endsection