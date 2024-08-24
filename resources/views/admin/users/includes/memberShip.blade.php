<div class="card d-print-none">
    <div class="card-header collapsible cursor-pointer rotate collapsed"
         data-bs-toggle="collapse"
         data-bs-target="#kt_docs_card_collapsible">
        <h3 class="card-title"> {{__("admin.Membership")}}</h3>
        <div class="card-toolbar rotate-180">
            <i class="ki-duotone ki-down fs-1">
            </i>
        </div>
    </div>
    <div id="kt_docs_card_collapsible" class="collapse">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-6 mb-3">
                    <label for="membership">{{__("admin.Membership")}}:</label>
                    <select name="membership" id="membership"
                            class="form-select @error('membership') is-invalid @enderror" data-control="select2"
                            data-placeholder="{{__('admin.Select')}}">
                        <option value="">{{__("admin.Select")}}</option>
                        @foreach($membershipTypes as $membershipType)
                            <option
                                value="{{$membershipType->id}}" {{@$selectedItem?->memberShip->first()?->member_ship_type_id == $membershipType->id ? "selected" : ""}}>
                                {{$membershipType->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="membership_start_date">{{__("admin.Membership start date")}}:</label>
                    <input type="date" class="form-control @error('membership_start_date') is-invalid @enderror"
                           id="membership_start_date" name="membership_start_date"
                           value="{{@$selectedItem?->memberShip->first()?->start_date ?? Carbon\Carbon::now()->format('Y-m-d')}}">
                    @error('membership_start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="membership_end_date">{{__("admin.Membership end date")}}:</label>
                    <input type="text" class="form-control @error('membership_end_date') is-invalid @enderror"
                           id="membership_end_date" disabled
                           value="{{@$selectedItem?->memberShip->first()?->end_date}}">
                    @error('membership_end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="membership_status">{{__("admin.Membership status")}}:</label>
                    <select name="membership_status" id="membership_status"
                            class="form-select @error('membership_status') is-invalid @enderror" data-control="select2"
                            data-placeholder="{{__('admin.Select')}}">
                        <option value="">{{__("admin.Select")}}</option>
                        <option value="1" {{@$selectedItem?->memberShip->first()?->record_state == 1 ? "selected" : ""}}>
                            {{__("admin.Active")}}
                        </option>
                        <option value="0" {{@$selectedItem?->memberShip->first()?->record_state == 0 ? "selected" : ""}}>
                            {{__("admin.Inactive")}}
                        </option>
                    </select>
                    @error('membership_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
