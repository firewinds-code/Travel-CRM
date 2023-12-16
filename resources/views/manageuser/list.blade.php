@extends('include.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-left">
                            <button type="button" class="btn btn-block bg-gradient-primary text-white form-control" data-inline="true" data-toggle="modal" onclick="add()" data-target="#addModal"><i class="fa fa-plus icon-white"></i>Add User </button>
                        </ol>
                    </div>
                </div>
                <div class="container-fluid">
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">User Management </h3>
                                </div>
                                <div class="card-body">
                                    <table id="manageUser" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Email</th>
                                                <th>Name</th>
                                                <th>Emp_ID</th>
                                                <th>Usertype</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<script type="text/javascript">
    $(function() {
        var table = $('#manageUser').DataTable({
            dom: 'Bfrtip',
            ajax: "{{ route('manageuser.list') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'emp_id',
                    name: 'emp_id'
                },
                {
                    data: 'usertype',
                    name: 'usertype',
                    render: function(data, type, row) 
                    {
                        // console.log("User Type:", data);
                        if (data == 1) 
                        {
                            return 'L2 Approver';
                        } 
                        else if (data == 2) 
                        {
                            return 'L1 Approver';
                        } 
                        else if (data == 0) 
                        {
                            return 'Super Admin';
                        } 
                        else if (data == 3) 
                        {
                            return 'Requester';
                        }
                        else 
                        {
                            return 'Unknown'; // Handle other cases if needed
                        }
                    }
                },
                {
                    data: 'action',
                    name: 'action',

                },
            ],
            buttons: [
                'csv'
            ],
          
        });
    });
</script>

<script>
    function add(id) {
        $.ajax({
            type: "get",
            url: "{{route('manageuser.add')}}",
            data: {
                "id": id
            },
            success: function(data) {
                console.log(data.url);
                $("#addModal").modal('show');
                $('#addbody').html(data.html);
            }
        });
    };
</script>

<script>
    function editUser(id) {
        $.ajax({
            type: "get",
            url: "{{route('manageuser.edit')}}",
            data: {
                "id": id
            },
            success: function(data) {
                console.log(data.url);
                $("#editModal").modal('show');
                $('#editbody').html(data.html);
            }
        });
    };
</script>

<script>
    function deleteUser(id) {
        var result = confirm('Do you want to Delete it');
        if (result == true) {
            $.ajax({
                url: "{{route('manageuser.delete')}}",
                type: 'GET',
                data: {
                    "id": id
                },
                success: function(response) {
                    //location.reload();
                    console.log(response.status);
                    if (response.status == 'success') {
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.reload(true);
                        }, 2000);
                    }
                    if (response.status == 'error') {
                        toastr.error(response.message);
                    }
                }
            });
        }
    }
</script>

<!-- /.content-wrapper -->

<div id="addModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white ">
                <h4 class="modal-title">Enter User Details Here:-</h4>
                <button type="button" style="color: #ffffff" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="card-body" id="addbody">
            </div>
        </div>
    </div>
</div>

<div id="editModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title">Enter User Details Here:-</h4>
                <button type="button" style="color: #ffffff" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="card-body" id="editbody">
            </div>
        </div>
    </div>
</div>
@endsection