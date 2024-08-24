<!--begin::Col-->
<div class="col-xl-12">
    <!--begin::List widget 21-->
    <div class="card card-flush h-xl-100">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-dark">{{__('admin.Subscription')}}</span>
                <span
                    class="text-muted mt-1 fw-semibold fs-7">{{__('admin.Subscription data and info')}}</span>
            </h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-5">
            @foreach($selectedItem->memberShip as $memberShip)
                <!--begin::Item-->
                <div class="d-flex flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-center me-3">
                        <!--begin::Section-->
                        <div class="flex-grow-1">
                            <!--begin::Text-->
                            <span class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">
                                                        {{$memberShip->membershipType->name}}
                                                    </span>
                            <!--end::Text-->
                            <!--begin::Description-->
                            <span class="text-gray-400 fw-semibold d-block fs-6">
                                                        {{$memberShip->start_date}} - {{$memberShip->end_date}}
                                                    </span>
                            <!--end::Description=-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Statistics-->
                    @php
                        if(isset($memberShip->end_date) && $memberShip->end_date != null){
                            // diff in days
                            $diffNowFromStart = strtotime(now()) - strtotime($memberShip->start_date); // 40
                            $diffEndFromStart = strtotime($memberShip->end_date) - strtotime($memberShip->start_date); // 30
                            $percentage = ($diffNowFromStart / $diffEndFromStart) * 100; // (40 / 30) * 100 = 133.33
                            if($percentage > 100){
                                $percentage = 100;
                            }
                        }else{
                            $percentage = 0;
                        }
                    @endphp
                    <div class="d-flex align-items-center w-100 mw-300px">
                        <!--begin::Progress-->
                        <div
                            class="progress h-6px me-5 w-100 {{$percentage < 100 ? 'bg-light-success' : 'bg-light-danger'}}">
                            <div class="progress-bar {{$percentage < 100 ? 'bg-success' : 'bg-danger'}}"
                                 role="progressbar"
                                 style="width: {{$percentage}}%" aria-valuenow="{{$percentage}}"
                                 aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                        <!--end::Progress-->
                        <!--begin::Value-->
                        <span class="text-gray-400 fw-semibold">{{round($percentage,2)}}%</span>
                        <!--end::Value-->
                    </div>
                    <!--end::Statistics-->
                </div>
                <!--end::Item-->
                <!--begin::Separator-->
                <div class="separator separator-dashed my-3"></div>
                <!--end::Separator-->
            @endforeach
            <div class="mt-5">
                <h4>
                    {{__('admin.Membership number')}}: {{$selectedItem->membership_number}}
                </h4>
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::List widget 21-->
</div>
<!--end::Col-->
