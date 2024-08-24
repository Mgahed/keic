@extends('main.master.master')
@section('pageContent')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('main.master.includes.toolbar')
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container">
                    <!--begin::Navbar-->
                    <div class="card card-flush mb-9" id="kt_user_profile_panel">
                        <!--begin::Hero nav-->
                        <div class="card-header rounded-top bgi-size-cover h-200px"
                             style="background-position: 100% 50%; background-image:url('{{asset('assets/media/misc/bg-2.jpg')}}')"></div>
                        <!--end::Hero nav-->
                        <!--begin::Body-->
                        <div class="card-body mt-n19">
                            <!--begin::Details-->
                            <div class="m-0">
                                <!--begin: Pic-->
                                <div class="d-flex flex-stack align-items-end pb-4 mt-n19">
                                    <div
                                            class="symbol symbol-125px symbol-lg-150px symbol-fixed position-relative mt-n3"
                                            data-bs-toggle="tooltip" data-bs-placement="right"
                                            title="{{$selectedItem->record_state ? __('admin.Active') : __('admin.Not Active')}}">
                                        <img src="{{asset('assets/media/avatars/blank.png')}}" alt="image"
                                             class="border border-white border-4" style="border-radius: 20px"/>
                                        <div
                                                class="position-absolute translate-middle bottom-0 start-100 ms-n1 mb-9 {{$selectedItem->record_state ? 'bg-success' : 'bg-danger'}} rounded-circle h-15px w-15px"></div>
                                    </div>
                                </div>
                                <!--end::Pic-->
                                <!--begin::Info-->
                                <div class="d-flex flex-stack flex-wrap align-items-end">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <div class="d-flex align-items-center mb-2"
                                             data-bs-toggle="tooltip" data-bs-placement="top"
                                             title="{{$selectedItem->memberShip->first()?->record_state ? __('admin.Active member') : __('admin.Not active member')}}">
                                            <a href="{{route('profile.edit')}}"
                                               class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1">
                                                {{$selectedItem->name}}
                                            </a>
                                            <div>
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                                <i class="ki-duotone ki-verify {{$selectedItem->memberShip->first()?->record_state ? 'text-success' : 'text-danger'}} fs-1 mt-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <!--end::Svg Icon-->
                                            </div>
                                        </div>
                                        <!--end::Name-->
                                        {{--<!--begin::Text-->
                                        <span class="fw-bold text-gray-600 fs-6 mb-2 d-block">Design is like a fart. If you have to force it, it’s probably shit.</span>
                                        <!--end::Text-->--}}
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center flex-wrap fw-semibold fs-7 pe-2">
                                            <span
                                                    class="d-flex align-items-center text-gray-400 text-hover-primary">
                                                {{$selectedItem->role}}
                                            </span>
                                            <span class="bullet bullet-dot h-5px w-5px bg-gray-400 mx-3"></span>
                                            <span class="d-flex align-items-center text-gray-400 text-hover-primary">
                                                {{$selectedItem->gender}}
                                            </span>
                                            <span class="bullet bullet-dot h-5px w-5px bg-gray-400 mx-3"></span>
                                            <span class="text-gray-400 text-hover-primary">
                                                {{$selectedItem->mobile}}
                                            </span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Details-->
                        </div>
                    </div>
                    <!--end::Navbar-->
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                        @include('profile.partials.subscription')

                        @include('profile.partials.change-password')

                        @include('profile.partials.configs')
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
@endsection



{{--
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
--}}
