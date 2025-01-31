<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container d-flex flex-stack w-100">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{$title ?? 'Mgahed\'s Dashboard'}}
            </h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Filter menu-->
            <div class="d-flex">
                @if(isset($addUrl))
                    <a class="btn btn-primary" href="{{$addUrl['url']}}">
                        {{$addUrl['text']}} <i class="fas fa-plus"></i>
                    </a>
                @endif
                @if(isset($timer))
                    <span class="badge badge-light-primary">
                    <h2 class="text-end mb-0 p-3">
                        <span id="timer">{{$timer}}</span>
                    </h2>
                    </span>
                @endif
            </div>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
