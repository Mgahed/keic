<div class="app-navbar-item ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
    <!--begin::Menu wrapper-->
    <div class="cursor-pointer symbol symbol-35px symbol-md-40px"
         data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
         data-kt-menu-placement="bottom-end">
        <img src="{{asset('assets/media/avatars/blank.png')}}" alt="user"/>
    </div>
    <!--begin::User account menu-->
    <div
        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
        data-kt-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <!--begin::Avatar-->
                <div class="symbol symbol-50px me-5">
                    <img alt="Logo" src="{{asset('assets/media/avatars/blank.png')}}"/>
                </div>
                <!--end::Avatar-->
                <!--begin::Username-->
                <div class="d-flex flex-column">
                    <div class="fw-bold d-flex align-items-center fs-5">
                        {{auth()->user()->name}}
                        <span
                            class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                            {{Auth::user()->roles->first()->display_name}}
                        </span>
                    </div>
                    <a href="#"
                       class="fw-semibold text-muted text-hover-primary fs-7">
                        {{auth()->user()->nid}}
                    </a>
                </div>
                <!--end::Username-->
            </div>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->
        <!--begin::Menu item-->
        {{--<div class="menu-item px-5">
            <a href="{{route('profile.edit')}}" class="menu-link px-5">{{__('admin.My Profile')}}</a>
        </div>--}}
        <!--end::Menu item-->
        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <a href="javascript:;" onclick="document.querySelector('form').submit()"
               class="menu-link px-5">{{__('admin.Sign Out')}}</a>
        </div>
        <!--end::Menu item-->
    </div>
    <!--end::User account menu-->
    <!--end::Menu wrapper-->
</div>

<form action="{{route('logout')}}" method="POST">
    @csrf
</form>
