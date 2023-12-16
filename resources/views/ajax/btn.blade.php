@if ($user->id == Auth::user()->id && ($user->approval_status != 'Rejected' || $user->approval_status != 'Approved'))
    <a onclick="editRequest({{ $user->id }})" href="#" class="btn btn-primary btn-sm" data-toggle="modal"
        data-target="#modal-default-lg-edit"><i class="nav-icon fa fa-edit" style="padding:2px"></i></a>
@else
    @if ($user->approval_status == 'Approved' || $user->approval_status == 'Rejected')
        @if ($user->approval_status == 'Approved')
            <span class="btn btn-success">{{ $user->approval_status }}</span>
        @else
            <span class="btn btn-danger">{{ $user->approval_status }}</span>
        @endif
    @else
        <a onclick="editRequest({{ $user->id }})" href="#" class="btn btn-primary btn-sm" data-toggle="modal"
            data-target="#modal-default-lg-edit"><i class="fa fa-edit" style="padding: 2px"></i></a>
        <a href="#" onclick="deleteRequest({{ $user->id }})" class="btn btn-danger btn-sm"> <i
                class="fa fa-trash" style="padding:2px"></i></a>
    @endif
@endif
