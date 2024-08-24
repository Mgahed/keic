@extends('main.auth.auth')
@section('pageContent')
    <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
        <!--begin::Form-->
        <div class="d-flex flex-center flex-column flex-lg-row-fluid">
            @include('layouts.alert')
            <!--begin::Wrapper-->
            <div class="w-lg-500px p-10">
                <!--begin::Form-->
                <form class="form w-100" id="kt_sign_in_form"
                      action="{{route('login')}}" method="post">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3">{{__('admin.Sign In')}}</h1>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Nid-->
                        <div id="nid-group my-5">
                            <label for="email">
                                {{__('admin.Nid or mobile')}}
                            </label>
                            <input type="text" placeholder="{{__('admin.Nid')}}" name="email" id="email" autocomplete="off"
                                   class="form-control bg-transparent @error('email') is-invalid @enderror"
                                   required/>
                            @error('email')
                            <div class="fv-plugins message-container invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <!--end::Nid-->
                        <div id="password-group my-5">
                            <label for="password">
                                {{__('admin.Password')}}
                            </label>
                            <input type="password" placeholder="{{__('admin.Password')}}" name="password" id="password" autocomplete="off"
                                   class="form-control bg-transparent @error('password') is-invalid @enderror"
                                   required/>
                            @error('password')
                            <div class="fv-plugins message-container invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <!--begin::Submit button-->
                    <div class="d-grid mb-10">
                        <button type="submit" id="sign_in_submit" class="btn btn-primary">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">{{__('admin.Sign In')}}</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">
                            {{__('admin.Please wait')}}...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>
                    </div>
                    <!--end::Submit button-->
                    <!--begin::Sign up-->
                    <div class="text-gray-500 text-center fw-semibold fs-6">
                        {{__('admin.Dont have an account')}}
                        <a href="{{route('register')}}"
                           class="link-primary">{{__('admin.Sign up')}}</a></div>
                    <!--end::Sign up-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Form-->
        <!--begin::Footer-->
        <div class="d-flex flex-center flex-wrap px-5">
            <!--begin::Links-->
            <div class="d-flex fw-semibold text-primary fs-base">
                <a href="tel:+201067554823" class="px-5" target="_blank">
                    <i class="fa-solid fa-phone" style="color: #3297FF;"></i>
                </a>
                <a href="https://www.facebook.com/people/%D8%A7%D8%B3%D8%A7%D9%85%D8%A9-%D8%A7%D9%84%D9%86%D8%AC%D8%A7%D8%B1/pfbid0BasM8rtwajFsvdp8BjcaFnoTUxy5FG2qcd58DFfyevkS7KQhwziUnCUf4TAcyz6jl/?mibextid=qi2Omg" class="px-5" target="_blank">
                    <i class="fa-brands fa-facebook-f" style="color: #3297FF;"></i>
                </a>
                <a href="https://mgahed.com/"
                   class="px-5" target="_blank">
                    <i class="fa-solid fa-m" style="color: #3297FF;"></i>
                </a>
            </div>
            <!--end::Links-->
        </div>
        <!--end::Footer-->
    </div>
@endsection

@section('pageScripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
