@extends('include.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <br>
                <form action="{{ route('portal.details') }}" method="post" id="travelDetails" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="modal-title">Enter Travel Details Here:-</h4>
                                </div>
                                <br>
                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select<span class="text-danger">*</span></label>
                                                    <select class="form-control select2bs4" style="width: 100%;"
                                                        name="vehicle" id="vehicle">
                                                        <option value="">Select Your Mode Of Travel</option>
                                                        <option value="car">Car</option>
                                                        <option value="bus">Bus</option>
                                                        <option value="train">Train</option>
                                                        <option value="flight">Flight</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Departure City<span class="text-danger">*</span></label>
                                                    <select class="form-control select2bs4" style="width: 100%;"
                                                        name="departure_city" id="departure_city">
                                                        <option value="">Select Your Departure City</option>
                                                        @foreach ($places as $key => $departure_city)
                                                            <option value="{{ $departure_city }}">{{ $departure_city }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Destination City<span class="text-danger">*</span></label>
                                                    <select class="form-control select2bs4" style="width: 100%;"
                                                        name="destination_city" id="destination_city">
                                                        <option value="">Select Your Destination City</option>
                                                        @foreach ($places as $key => $destination_city)
                                                            <option value="{{ $destination_city }}">{{ $destination_city }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="reservationdatetime">Departure Date & Time<span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group date" id="reservationdatetime"
                                                        name="reservationdatetime" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input"
                                                            id="reservation_date_time" name="reservation_date_time"
                                                            data-target="#reservationdatetime" />
                                                        <div class="input-group-append" data-target="#reservationdatetime"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Purpose Of Travel<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control select2bs4" style="width: 100%;"
                                                        name="reason" id="reason">
                                                        <option value="">Select Purpose Of Travel</option>
                                                        <option value="Meeting with Client">Meeting with Client</option>
                                                        <option value="MBR/QBR">MBR/QBR</option>
                                                        <option value="Resolution of an issue with client">Resolution of an
                                                            issue with client</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Process<span class="text-danger">*</span></label>
                                                    <select class="form-control select2bs4" style="width: 100%;"
                                                        name="process" id="process">
                                                        <option value="">Select Your Process</option>
                                                        @if (isset($process))
                                                            @foreach ($process as $key => $list)
                                                                <option value="{{ $list }}">
                                                                    {{ $list }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                        <option value="others">Others</option>
                                                    </select>
                                                </div>

                                                @if(Auth::user()->usertype==1||Auth::user()->usertype==0)
                                                <div class="form-group" id="other_process_div">
                                                    <label>Other Process<span class="text-danger">*</span></label>
                                                    <input type="text" name="other_process" id="other_process"
                                                        class="form-control">
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Accomodation<span class="text-danger">*</span></label>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-success d-inline">
                                                            <input type="radio" value="Yes" id="radio1"
                                                                name="accomodation">
                                                            <label for="radio1">Yes</label>
                                                        </div>
                                                        <div class="icheck-danger d-inline">
                                                            <input type="radio" value="No" id="radio2"
                                                                name="accomodation">
                                                            <label for="radio2">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Days Required<span class="text-danger">*</span></label>
                                                    <input name="days_required" type="number" class="form-control"
                                                        id="days_required" max="999">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group" id="advance_required_div">
                                                    <label>Advance Required<span class="text-danger">*</span></label>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-success d-inline">
                                                            <input type="radio" id="radioPrimary1"
                                                                name="advance_required" value="Yes">
                                                            <label for="radioPrimary1">Yes
                                                            </label>
                                                        </div>
                                                        <div class="icheck-danger d-inline">
                                                            <input type="radio" id="radioPrimary2"
                                                                name="advance_required" value="No">
                                                            <label for="radioPrimary2">No
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" id="amount_div">
                                                    <label>Advance Amount<span class="text-danger">*</span></label>
                                                    <input name="amount" type="number" class="form-control"
                                                        id="amount">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <button onclick="" name="submit" type="submit"
                                                class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.row -->
            </div>
        </div>
    </div>
    <!-- /.content -->

    <script>
        $(function() {

            $('#other_process_div').hide();
            $('#process').on('change', function() {
                var process = $(this).val();
                if (process == "others") {
                    $('#other_process_div').show();
                } else {
                    $('#other_process_div').hide();
                }

            });

            $('#amount_div').hide();
            $(document).ready(function() {
                $("#radioPrimary1, #radioPrimary2").change(function() {
                    if ($("#radioPrimary1").is(":checked")) {
                        $('#amount_div').show();
                    }
                    if ($("#radioPrimary2").is(":checked")) {
                        $('#amount_div').hide();
                    }

                });
            });


            $('#travelDetails').validate({
                rules: {
                    vehicle: {
                        required: true
                    },
                    other_process: {
                        required: true
                    },
                    departure_city: {
                        required: true
                    },
                    destination_city: {
                        required: true
                    },
                    reservation_date_time: {
                        required: true
                    },
                    reason: {
                        required: true
                    },
                    process: {
                        required: true
                    },
                    accomodation: {
                        required: true
                    },
                    days_required: {
                        required: true
                    },
                    advance_required: {
                        required: true
                    },
                    amount: {
                        required: true
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

@endsection
