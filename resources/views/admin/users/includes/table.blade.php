<div class="table-responsive">
    <table id="usersTable"
           class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
        <thead>
        <tr class="fw-semibold fs-6 text-gray-800">
            <th class="text-start">{{__('#')}}</th>
            <th class="text-start">{{__('admin.Role')}}</th>
            <th class="text-start">{{__('admin.Name')}}</th>
            <th class="text-start">{{__('admin.Nid')}}</th>
            <th class="text-start">{{__('admin.Mobile')}}</th>
            <th class="text-start">{{__('admin.Membership number')}}</th>
            <th class="text-start">{{__('admin.Academic stage')}}</th>
            <th class="text-start">{{__('admin.Gender')}}</th>
            <th class="text-start">{{__('admin.Birth date')}}</th>
            <th class="text-start">{{__('admin.Actions')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->role}}</td>
                <td>{{@$item->name}}</td>
                <td>{{@$item->nid}}</td>
                <td>{{@$item->mobile}}</td>
                <td>{{@$item->membership_number}}</td>
                <td>{{@$item->academicStage->name}}</td>
                <td>{{@$item->gender}}</td>
                <td>{{@$item->birth_date}}</td>
                <td>
                    <a href="{{route('admin.users.show', $item->id)}}"
                       class="btn btn-icon btn-primary btn-sm me-1">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
