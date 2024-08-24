@extends('main.auth.auth')
@section('pageContent')
    <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
        <!--begin::Form-->
        <form class="form w-100" id="kt_sign_in_form"
              action="{{route('register')}}" method="post">
            <!--begin::Form-->
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3">{{__('admin.Sign up')}}</h1>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group=-->
                    <div class="fv-row row mb-8">
                        <!--begin::Name-->
                        <div id="name-group" class="col-4 mb-5">
                            <label for="name">
                                {{__('admin.Name')}}
                            </label>
                            <input type="text" placeholder="{{__('admin.Name')}}" name="name" id="name"
                                   autocomplete="off"
                                   class="form-control bg-transparent @error('name') is-invalid @enderror" required
                                   value="{{old('name')}}"
                            />
                            @error('name')
                            <div class="fv-plugins message-container invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <!--end::Name-->
                        <!--begin::Nid-->
                        <div id="nid-group" class="col-4 mb-5">
                            <label for="nid">
                                {{__('admin.Nid')}}
                            </label>
                            <input type="number" maxlength="14" placeholder="{{__('admin.Nid')}}" name="nid" id="nid"
                                   autocomplete="off"
                                   class="form-control bg-transparent @error('nid') is-invalid @enderror" required
                                   value="{{old('nid')}}"
                            />
                            @error('nid')
                            <div class="fv-plugins message-container invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <!--begin::Mobile-->
                        <div id="moile-group" class="col-4 mb-5">
                            <label for="nid">
                                {{__('admin.Mobile')}}
                            </label>
                            <input type="text" placeholder="{{__('admin.Mobile')}}" name="mobile" id="mobile"
                                   autocomplete="off"
                                   class="form-control bg-transparent @error('mobile') is-invalid @enderror" required
                                   value="{{old('mobile')}}"
                            />
                            @error('mobile')
                            <div class="fv-plugins message-container invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <!--end::Mobile-->
                    </div>

                    <hr>

                    <!--if a member-->
                    <div class="fv-row row mb-8">
                        <!--begin::Type-->
                        <div id="already-member-group" class="col-6 mb-5">
                            <h4 for="qType">
                                {{__('admin.Already a member')}}
                            </h4>
                            <div class="d-flex justify-content-between">
                                <div class="form-check form-check-custom form-check-success form-check-solid">
                                    <input class="form-check-input" name="member_already" type="radio" value="1"
                                           id="yesMember"/>
                                    <label class="form-check-label" for="yesMember">
                                        {{__('admin.Yes')}}
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-danger form-check-solid">
                                    <input class="form-check-input" name="member_already" type="radio" value="0" checked
                                           id="notMember"/>
                                    <label class="form-check-label" for="notMember">
                                        {{__('admin.No')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="ifMember" class="fv-row row mb-8 d-none">
                        <!--begin::Type-->
                        {{--<div id="membership-number-group" class="col-6 mb-5">
                            <label for="membership_number">
                                {{__('admin.Membership number')}}
                            </label>
                            <input type="text" placeholder="{{__('admin.Membership number')}}" name="membership_number"
                                   id="membership_number"
                                   autocomplete="off"
                                   class="form-control bg-transparent @error('membership_number') is-invalid @enderror"
                                   value="{{old('membership_number')}}"
                            />
                            @error('membership_number')
                            <div class="fv-plugins message-container invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>--}}
                        <div id="membership-type-group" class="col-12 mb-5">
                            <label for="membership_type">
                                {{__('admin.Membership type')}}
                            </label>
                            <select id="membership_type" name="membership_type" class="form-select @error('membership_type') is-invalid @enderror" data-control="select2" data-placeholder="{{__('admin.Select')}}">
                                <option></option>
                                @foreach($membershipTypes as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                            @error('membership_type')
                            <div class="fv-plugins message-container invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <hr>

                    <!--if a member-->
                    <div class="fv-row row mb-8">
                        <!--begin::Type-->
                        <div id="student-group" class="col-6 mb-5">
                            <h4 for="aStudent">
                                {{__('admin.Are you a student')}}
                            </h4>
                            <div class="d-flex justify-content-between">
                                <div class="form-check form-check-custom form-check-success form-check-solid">
                                    <input class="form-check-input" name="student" type="radio" value="1"
                                           id="yesStudent"/>
                                    <label class="form-check-label" for="yesStudent">
                                        {{__('admin.Yes')}}
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-danger form-check-solid">
                                    <input class="form-check-input" name="student" type="radio" value="0" checked
                                           id="notStudent"/>
                                    <label class="form-check-label" for="notStudent">
                                        {{__('admin.No')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="ifStudent" class="fv-row row mb-8 d-none">
                        <div id="academic-stage-group" class="col-5 mb-5">
                            <label for="academic_stage">
                                {{__('admin.Academic stage')}}
                            </label>
                            <select id="academic_stage" name="academic_stage" class="form-select @error('academic_stage') is-invalid @enderror" data-control="select2" data-placeholder="{{__('admin.Select')}}">
                                <option></option>
                                @foreach($academicStages as $stage)
                                    <option value="{{$stage->id}}">{{$stage->name}}</option>
                                @endforeach
                            </select>
                            @error('academic_stage')
                            <div class="fv-plugins message-container invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-8">
                        <div id="pass-group" class="col-6 mb-5">
                            <label for="password">
                                {{__('admin.Password')}}
                            </label>
                            <input type="password" placeholder="{{__('admin.Password')}}" name="password" id="password"
                                   autocomplete="off"
                                   class="form-control bg-transparent @error('password') is-invalid @enderror" required
                                   value="{{old('password')}}"
                            />
                            @error('password')
                            <div class="fv-plugins message-container invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div id="pass-group" class="col-6 mb-5">
                            <label for="confirm_password">
                                {{__('admin.Confirm')}} {{__('admin.Password')}}
                            </label>
                            <input type="password" placeholder="{{__('admin.Confirm')}} {{__('admin.Password')}}" name="confirm_password" id="confirm_password"
                                   autocomplete="off"
                                   class="form-control bg-transparent @error('confirm_password') is-invalid @enderror" required
                                   value="{{old('confirm_password')}}"
                            />
                            @error('confirm_password')
                            <div class="fv-plugins message-container invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>


                    <!--begin::Submit button-->
                    <div class="d-grid mb-10">
                        <button type="submit" id="sign_up_submit" class="btn btn-primary">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">{{__('admin.Sign up')}}</span>
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
                        {{__('admin.Do you have an account')}}
                        <a href="{{route('login')}}"
                           class="link-primary">{{__('admin.Sign In')}}</a></div>
                    <!--end::Sign up-->
                </div>
                <!--end::Wrapper-->
            </div>
        </form>
        <!--end::Form-->

        <!--begin::Footer-->
        <div class="d-flex flex-center flex-wrap px-5">
            <!--begin::Links-->
            <div class="d-flex fw-semibold text-primary fs-base">
                <a href="tel:+201067554823" class="px-5" target="_blank">
                    <i class="fa-solid fa-phone" style="color: #3297FF;"></i>
                </a>
                <a href="https://www.facebook.com/people/%D8%A7%D8%B3%D8%A7%D9%85%D8%A9-%D8%A7%D9%84%D9%86%D8%AC%D8%A7%D8%B1/pfbid0BasM8rtwajFsvdp8BjcaFnoTUxy5FG2qcd58DFfyevkS7KQhwziUnCUf4TAcyz6jl/?mibextid=qi2Omg"
                   class="px-5" target="_blank">
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
    {{--<script>
        const selectInput = document.getElementById('qType');
        selectInput.addEventListener('invalid', function () {
            if (selectInput.validity.valueMissing) {
                selectInput.setCustomValidity('من فضلك اختر المستوى');
            } else {
                selectInput.setCustomValidity('');
            }
        });
        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toastr-top-center",
            "preventDuplicates": false,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>--}}

    <script>
        $(document).ready(function () {
            $('#yesStudent').on('change', function () {
                $('#ifStudent').removeClass('d-none');
            });
            $('#notStudent').on('change', function () {
                $('#ifStudent').addClass('d-none');
            });
            $('#yesMember').on('change', function () {
                $('#ifMember').removeClass('d-none');
            });
            $('#notMember').on('change', function () {
                $('#ifMember').addClass('d-none');
            });
        });
    </script>
@endsection
