@extends('admin.layouts.back-app')
@section('content')

    <div class="svg-container">
        <!-- I crated SVG with: https://codepen.io/anthonydugois/pen/mewdyZ -->
        <svg viewBox="0 0 800 200" class="svg">
            <path id="curve" fill="#ff2952" d="M 800 100 Q 400 150 0 100 L 0 0 L 800 0 L 800 100 Z">
            </path>
        </svg>
    </div>
    <div class="background"></div>
    <div class="j-wrapper j-wrapper-400">
        <form action="{{ route('admin.login') }}" method="post" class="j-pro" id="j-pro" novalidate="">
        @csrf
            <!-- end /.header -->
            <div class="j-content {{ $errors->has('email') ? ' is-error' : '' }}">
                <!-- start login -->
                <div class="j-unit">
                    <div class="j-input">
                        <label class="j-icon-right" for="email">
                            <i class="icofont icofont-ui-user"></i>
                        </label>
                        <input type="email" id="email" name="email" placeholder="your login..." value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                <!-- end login -->
                <!-- start password -->
                <div class="j-unit">
                    <div class="j-input">
                        <label class="j-icon-right" for="password">
                            <i class="icofont icofont-lock"></i>
                        </label>
                        <input type="password" id="password" name="password" placeholder="your password...">
                        {{--<span class="j-hint">--}}
                            {{--<a href="#" class="j-link">فراموشی رمز عبور</a>--}}
                        {{--</span>--}}
                        @if ($errors->has('email'))
                            <span class="error">{{ $errors->first('email') }}</span>
                        @endif
                        @if ($errors->has('password'))
                            <span class="error">{{ $errors->first('password') }}</span>
                        @endif

                    </div>
                </div>
                <!-- end password -->
            </div>
            <!-- end /.content -->
            <div class="j-footer">
                <button type="submit" class="btn btn-primary w-50">ورود</button>
            </div>
            <!-- end /.footer -->
        </form>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{url('cms/assets')}}/js/particleground/jquery.particleground.js"></script>
    <script>
        $('body').ready(function () {
            $('.background').particleground({
                dotColor: '#fff',
                lineColor: '#fff',
                particleRadius: 4
            });
        });
    </script>
@endsection