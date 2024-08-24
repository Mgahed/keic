@extends('main.master.master')
@section('pageContent')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <div class="container-fluid h-100">
                <h1>
                    {{__('admin.Welcome')}} {{Auth::user()->name}}
                </h1>
            </div>
        </div>
        <!--end::Content wrapper-->

        @permission('check-user-active')
        @php($users = \App\Models\User::all())
        <div class="container-fluid h-100 my-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom card-stretch">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">
                                    {{__('admin.Check User Active')}}
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.users.checkUserActive')}}" method="post">
                                @csrf
                                <div class="form-group row mb-5">
                                    <div class="col-lg-6">
                                        <label for="user_id">{{__('admin.User')}}</label>
                                        <select name="user_id" id="user_id" class="form-control" data-control="select2" data-placeholder="{{__('admin.Select')}}">
                                            <option value="">{{__('admin.Select')}}</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}} - {{$user->nid}} - {{$user->mobile}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">{{__('admin.Check')}}</button>
                            </form>

                            @if(session()->has('checkedUser'))
                                @php($userChecked = session()->get('checkedUser'))
                                <div class="mt-5 text-center">
                                    <h3 class="mb-3">{{__('admin.User')}}: {{$userChecked->name}}</h3>
                                    <h3 class="mb-3 {{$userChecked->record_state ? 'text-success' : 'text-danger'}}">
                                        {{__('admin.Status')}}: <span>{{$userChecked->record_state ? __('admin.Active') : __('admin.Inactive')}}</span>
                                    </h3>
                                    <h3 class="mb-3 {{$userChecked->memberShip->first()?->record_state ? 'text-success' : 'text-danger'}}">
                                        {{__('admin.Membership')}}: <span>{{$userChecked->memberShip->first()?->record_state ? __('admin.Active') : __('admin.Inactive')}}</span>
                                    </h3>
                                    <h3 class="mb-5 {{$userChecked->memberShip->first()?->end_date < now() ? 'text-danger' : 'text-success'}}">
                                        {{__('admin.Membership end date')}}: <span>{{$userChecked->memberShip->first()?->end_date}}</span>
                                    </h3>
                                    <h1>
                                        @if($userChecked->memberShip->first()?->end_date < now())
                                            {{__('admin.Membership expired')}}
                                        @else
                                            {{now()->diffInDays($userChecked->memberShip->first()->end_date)}} {{__('admin.Days remaining')}}
                                        @endif
                                    </h1>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endpermission
    </div>
@endsection
