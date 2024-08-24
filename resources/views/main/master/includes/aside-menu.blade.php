<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper my-5"
         data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
         data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
        @php
            $currentRouteName = request()->route()->getName();
        @endphp
            <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold px-3"
             id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
            @role('super-admin|admin')
            <!--begin:Menu item-->
            <div class="menu-item pt-5">
                <!--begin:Menu content-->
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">{{__('admin.Admin')}}</span>
                </div>
                <!--end:Menu content-->
            </div>
            <!--end:Menu item-->

            <!--Users-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link @if(str_contains($currentRouteName, 'admin.users')){{'active'}}@endif"
                   href="{{route('admin.users.index')}}">
                    <span class="menu-icon">
                        <i class="fa fa-list"></i>
                    </span>
                    <span class="menu-title">{{__('admin.Users')}}</span>
                </a>
                <!--end:Menu link-->
            </div>

            <!--Lookups-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link @if(str_contains($currentRouteName, 'lookups')){{'active'}}@endif"
                   href="{{route('lookups.index')}}">
                    <span class="menu-icon">
                        <i class="fa fa-list"></i>
                    </span>
                    <span class="menu-title">{{__('admin.Lookups')}}</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->

            <!--Translations-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link @if(str_contains($currentRouteName, 'translation')){{'active'}}@endif"
                   href="{{route('translations.index')}}">
                    <span class="menu-icon">
                        <i class="fa fa-list"></i>
                    </span>
                    <span class="menu-title">{{__('admin.Translations')}}</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->

            @role('super-admin')
            <!--Laratrust-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" target="_blank"
                   href="{{url('/laratrust')}}">
                    <span class="menu-icon">
                        <i class="fa fa-list"></i>
                    </span>
                    <span class="menu-title">{{__('admin.Roles Permissions')}}</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
            @endrole
            @endrole
            <!--begin:Menu item-->
            <div class="menu-item pt-5">
                <!--begin:Menu content-->
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">{{__('admin.Member')}}</span>
                </div>
                <!--end:Menu content-->
            </div>
            <!--end:Menu item-->

            <!--Profile-->
            <div class="menu-item">
                 <!--begin:Menu link-->
                    <a class="menu-link @if(request()->routeIs('profile.edit')){{'active'}}@endif"
                       href="{{route('profile.edit')}}">
                        <span class="menu-icon">
                            <i class="fa fa-list"></i>
                        </span>
                        <span class="menu-title">{{__('admin.My Profile')}}</span>
                    </a>
                    <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
