<!--begin::Col-->
<div class="col-xl-8">
    <!--begin::List widget 1-->
    <div class="card card-flush h-md-100 mb-5 mb-lg-10">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-dark">{{__('admin.Change password')}}</span>
            </h3>
            <!--end::Title-->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-5">
            <form action="{{route('profile.change-password')}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group mb-5">
                    <label for="current_password">{{__('admin.Current password')}}</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                           id="current_password" name="current_password">
                    @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-5">
                    <label for="password">{{__('admin.New password')}}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-5">
                    <label for="password_confirmation">{{__('admin.Confirm new password')}}</label>
                    <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror"
                           id="password_confirmation" name="password_confirmation">
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
            </form>
        </div>
        <!--end::Body-->
    </div>
    <!--end::LIst widget 1-->
</div>
<!--end::Col-->
