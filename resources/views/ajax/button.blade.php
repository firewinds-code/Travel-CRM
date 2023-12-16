@if ($user->id == Auth::user()->id) 
    <a onclick="editRequest({{ $user->id }})" href="#"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default-lg-edit"><i class="nav-icon fa fa-edit" style="padding:2px"></i></a>
@else 
    <a onclick="editRequest({{ $user->id }})" href="#"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default-lg-edit"><i class="fa fa-edit" style="padding: 2px"></i></a>
@endif
