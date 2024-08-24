<div class="card d-print-none">
    <div class="card-header collapsible cursor-pointer rotate collapsed"
         data-bs-toggle="collapse"
         data-bs-target="#kt_configs">
        <h3 class="card-title"> {{__("admin.Configurations and other data")}}</h3>
        <div class="card-toolbar rotate-180">
            <i class="ki-duotone ki-down fs-1">
            </i>
        </div>
    </div>
    <div id="kt_configs" class="collapse">
        <div class="card-body">
            <!--begin::Repeater-->
            <div id="configs">
                <!--begin::Form group-->
                <div class="form-group">
                    <div data-repeater-list="configs">
                        @if(isset($selectedItem) && json_decode($selectedItem->configurations) !== null)
                            @foreach(json_decode($selectedItem->configurations) as $configs)
                                @foreach($configs as $key => $config)
                                    <div class="mb-5" data-repeater-item>
                                        <div class="form-group row">
                                            <div class="mb-5 col-md-4">
                                                <input type="text" class="form-control"
                                                       name="config_key"
                                                       value="{{@$key}}">
                                            </div>
                                            <div class="mb-5 col-md-4">
                                                <input type="text" class="form-control"
                                                       name="config_value"
                                                       value="{{@$config}}">
                                            </div>
                                            <div class="mb-5 col-md-4">
                                                <a href="javascript:;" data-repeater-delete
                                                   class="btn btn-sm btn-light-danger">
                                                    <i class="fa fa-trash fs-5"></i>
                                                    {{__('admin.Delete')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @else
                            <div class="mb-5" data-repeater-item>
                                <div class="form-group row">
                                    <div class="mb-5 col-md-4">
                                        <input type="text" class="form-control"
                                               name="config_key"
                                               value="">
                                    </div>
                                    <div class="mb-5 col-md-4">
                                        <input type="text" class="form-control"
                                               name="config_value"
                                               value="">
                                    </div>
                                    <div class="mb-5 col-md-4">
                                        <a href="javascript:;" data-repeater-delete
                                           class="btn btn-sm btn-light-danger">
                                            <i class="fa fa-trash fs-5"></i>
                                            {{__('admin.Delete')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!--end::Form group-->

                <!--begin::Form group-->
                <div class="form-group mt-5">
                    <a href="javascript:" data-repeater-create class="btn btn-light-primary">
                        <i class="fa fa-plus fs-3"></i>
                        {{__('admin.Add')}}
                    </a>
                </div>
                <!--end::Form group-->
            </div>
            <!--end::Repeater-->
        </div>
    </div>
</div>
