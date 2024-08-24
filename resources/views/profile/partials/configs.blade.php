<!--begin::Col-->
<div class="col-xl-4">
    <!--begin::List widget 2-->
    <div class="card card-flush h-md-100 mb-5 mb-lg-10">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-dark">{{__('admin.Configurations and other data')}}</span>
            </h3>
            <!--end::Title-->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-5">
            @if(json_decode($selectedItem->configurations) !== null)
                @foreach(json_decode($selectedItem->configurations) as $configs)
                    @foreach($configs as $key => $config)
                        <div class="d-flex flex-stack">
                            <!--begin::Item-->
                            <!--begin::Title-->
                            <p class="fs-2">
                                {{$key}}:
                            </p>
                            <!--end::Title-->
                            <!--begin::value-->
                            <p class="fs-2">
                                {{$config}}
                            </p>
                            <!--end::value-->
                            <span></span>
                        </div>
                    @endforeach
                    @if(!$loop->last)
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-3"></div>
                        <!--end::Separator-->
                    @endif
                @endforeach
            @else
                <!--begin::Title-->
                <p class="text-primary opacity-75-hover fs-6 fw-semibold">
                    {{__('admin.No additional data found')}}
                </p>
            @endif
        </div>
        <!--end::Body-->
    </div>
    <!--end::List widget 2-->
</div>
<!--end::Col-->
