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
                                <button type="button" class="btn btn-block bg-gradient-primary text-white form-control"
                                    data-inline="true"><i class="fa fa-plus icon-white"></i><a
                                        href="{{ route('portal.view') }}" style="color: white"> Add Request</a></button>
                            </ol>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Travel Management </h3>
                                    </div>
                                    <div class="card-body">
                                        <div style="overflow-x:auto;">
                                            <table id="manageTravel" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Travel Id</th>
                                                        <th>Employee Name</th>
                                                        <th>Emp ID</th>
                                                        <th>Designation</th>
                                                        <th>Mode Of Travel</th>
                                                        <th>Departure City</th>
                                                        <th>Destination City</th>
                                                        <th>Departure Date & Time</th>
                                                        <th>Purpose Of Travel</th>
                                                        <th>Process</th>
                                                        <th>Accomodation</th>
                                                        <th>No. Of Days</th>
                                                        <th>Advance Required</th>
                                                        <th>Advance Amount</th>
                                                        {{-- <th>Approval Status</th> --}}
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
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
            var table = $('#manageTravel').DataTable({
                dom: 'Bfrtip',
                ajax: "{{ route('portal.table') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
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
                        render: function(data, type, row) {
                            if (data == 1) {
                                return 'L2 Approver';
                            } else if (data == 2) {
                                return 'L1 Approver';
                            } else if (data == 3) {
                                return 'Requester';
                            } else {
                                return 'Unknown'; // Handle other cases if needed
                            }
                        }
                    },
                    {
                        data: 'vehicle',
                        name: 'vehicle'
                    },
                    {
                        data: 'departure_city',
                        name: 'departure_city'
                    },
                    {
                        data: 'destination_city',
                        name: 'destination_city'
                    },
                    {
                        data: 'reservation_date_time',
                        name: 'reservation_date_time'
                    },
                    {
                        data: 'reason',
                        name: 'reason'
                    },
                    {
                        data: 'process',
                        name: 'process'
                    },
                    {
                        data: 'accomodation',
                        name: 'accomodation'
                    },
                    {
                        data: 'days_required',
                        name: 'days_required'
                    },
                    {
                        data: 'advance_required',
                        name: 'advance_required'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    // {
                    //     data: 'approval_status',
                    //     name: 'approval_status',
                    //     render: function(data, type, row) {
                    //         if (data) {
                    //             return data;
                    //         } 
                    //         else {
                    //             return 'Pending'; // Handle other cases if needed
                    //         }
                    //     }
                    // },
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
        function editRequest(id) {
            $.ajax({
                type: "get",
                url: "{{ route('portal.edit') }}",
                data: {
                    "id": id
                },
                success: function(data) {
                    console.log(data.url);
                    $("#editModal").modal('show');
                    $('#editbody').html(data.html);
                    // alert("hew");
                }
            });
        };
    </script>

    <script>
        function deleteRequest(id) {
            var result = confirm('Do you want to Delete it ?');
            if (result == true) {
                $.ajax({
                    url: "{{ route('portal.delete') }}",
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
    
    <div id="editModal" class="modal fade">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title">Edit Travel Details Here:-</h4>
                    <button type="button" style="color: #ffffff" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="card-body" id="editbody">
                </div>
            </div>
        </div>
    </div>
@endsection
