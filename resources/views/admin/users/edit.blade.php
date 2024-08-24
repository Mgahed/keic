@extends('main.master.master')
@section('pageContent')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            @include('main.master.includes.toolbar')
            <form method="post" action="{{$action}}"
                  enctype="multipart/form-data">
                @csrf
                @method($method)
                <div class="app-container container-fluid">
                    <!--begin::table-->
                    @role('super-admin|admin')
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="row">
                                    <div class="mb-5 col-md-6">
                                        <label for="name" class="form-label">{{__('admin.Name')}}</label>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               id="name"
                                               value="{{@$selectedItem->name}}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-5 col-md-6">
                                        <label for="academic_stage"
                                               class="form-label">{{__('admin.Academic stage')}}</label>
                                        <select class="form-select @error('academic_stage') is-invalid @enderror"
                                                data-control="select2"
                                                data-placeholder="Select an option"
                                                id="academic_stage" name="academic_stage">
                                            <option></option>
                                            @foreach($academicStages as $academicStage)
                                                <option value="{{$academicStage->id}}"
                                                        @if($academicStage->id == @$selectedItem->academic_stage_id) selected @endif>{{$academicStage->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('academic_stage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-5 col-md-6">
                                        <label for="gender" class="form-label">{{__('admin.Gender')}}</label>
                                        <input type="text" class="form-control"
                                               id="gender" disabled
                                               value="{{@$selectedItem->gender}}">
                                    </div>
                                    <div class="mb-5 col-md-6">
                                        <label for="birth_date" class="form-label">{{__('admin.Birth date')}}</label>
                                        <input type="text" class="form-control"
                                               id="birth_date" disabled
                                               value="{{@$selectedItem->birth_date}}">
                                    </div>
                                    <div class="mb-5 col-md-6">
                                        <label for="role" class="form-label">{{__('admin.Role')}}</label>
                                        <input type="text" class="form-control"
                                               id="role" disabled
                                               value="{{@$selectedItem->role}}">
                                    </div>
                                    <div class="mb-5 col-md-6">
                                        <label for="nid" class="form-label">{{__('admin.Nid')}}</label>
                                        <input type="text" class="form-control @error('nid') is-invalid @enderror"
                                               id="nid" @permission('user-edit') '' @else disabled @endpermission
                                        name="nid"
                                        value="{{@$selectedItem->nid}}">
                                        @error('nid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{--<div class="mb-5 col-md-6">
                                        <label for="membership_number"
                                               class="form-label">{{__('admin.Membership number')}}</label>
                                        <input type="text"
                                               class="form-control @error('membership_number') is-invalid @enderror"
                                               id="membership_number" @permission('user-edit') '' @else
                                            disabled @endpermission name="membership_number"
                                            value="{{@$selectedItem->membership_number}}">
                                            @error('membership_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                    </div>--}}
                                    <div class="mb-5 col-md-6">
                                        <label for="mobile" class="form-label">{{__('admin.Mobile')}}</label>
                                        <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                               id="mobile" @permission('user-edit') '' @else disabled @endpermission
                                        name="mobile"
                                        value="{{@$selectedItem->mobile}}">
                                        @error('mobile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-5 col-md-6 d-flex justify-items-center">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" id="record_state"
                                                   name="record_state" @permission('user-edit') '' @else
                                                disabled @endpermission
                                                {{@$selectedItem->record_state == App\Enums\RecordState::ACTIVE->value ? 'checked' : ''}}
                                                />

                                                <label class="form-check-label" for="record_state">
                                                    {{__('admin.Status')}}
                                                </label>
                                                @error('record_state')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                </div>

                                <br>

                            </div>
                        </div>
                    </div>
                    <br>
                    @include('admin.users.includes.memberShip')
                    <br>
                    @include('admin.users.includes.repeater')
                    @endrole

                    <div class="card-footer my-5">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Content wrapper-->
    </div>
@endsection
@section('pageScripts')
    <script>
        $(document).ready(function () {
            $("#membership_start_date").flatpickr();
            $("#membership_end_date").flatpickr();
        });
    </script>
    <script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
    <script>
        $(document).ready(function () {
            // wait 2 seconds
            $('#configs').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'key',
                },

                show: function () {
                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        });
    </script>
@endsection
