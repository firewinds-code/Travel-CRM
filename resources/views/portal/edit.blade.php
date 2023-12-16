<form action="{{ route('portal.update') }}" method="post" id="travelDetails" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Travel ID</label>
                                    <input name="travel_id" value="{{ $query->id }}" type="name"
                                        class="form-control" id="travel_id" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Employee Name</label>
                                    <input name="name" value="{{ $query->name }}" type="name"
                                        class="form-control" id="name" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Employee ID</label>
                                    <input name="emp_id" value="{{ $query->emp_id }}" type="text"
                                        class="form-control" id="emp_id" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Designation</label>
                                    <input name="usertype"
                                        value="@if ($query->usertype == 1) {{ __('L2 Approver') }} @elseif($query->usertype == 2) {{ __('L1 Approver') }} @elseif($query->usertype == 3) {{ __('Requester') }} @else {{ __('Not Found') }} @endif "
                                        type="text" class="form-control" id="usertype" readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mode Of Travel<span class="text-danger">*</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="vehicle"
                                        id="vehicle">
                                        <option value="car" {{ $query->vehicle == 'car' ? 'selected' : '' }}>Car
                                        </option>
                                        <option value="bus" {{ $query->vehicle == 'bus' ? 'selected' : '' }}>Bus
                                        </option>
                                        <option value="train" {{ $query->vehicle == 'train' ? 'selected' : '' }}>
                                            Train</option>
                                        <option value="flight" {{ $query->vehicle == 'flight' ? 'selected' : '' }}>
                                            Flight</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Departure City<span class="text-danger">*</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="departure_city"
                                        id="departure_city">
                                        <option value="">Select Your Departure City</option>
                                        @foreach ($places as $key => $departure_city)
                                            <option value="{{ $departure_city }}"
                                                {{ $departure_city == $query->departure_city ? 'selected' : '' }}>
                                                {{ $departure_city }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Destination City<span class="text-danger">*</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="destination_city"
                                        id="destination_city">
                                        <option value="">Select Your Destination City</option>
                                        @foreach ($places as $key => $destination_city)
                                            <option value="{{ $destination_city }}"
                                                {{ $destination_city == $query->destination_city ? 'selected' : '' }}>
                                                {{ $destination_city }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="reservationdatetime">Departure Date & Time<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            id="reservation_date_time" name="reservation_date_time"
                                            data-target="#reservationdatetime"
                                            value="{{ $query->reservation_date_time }}" />
                                        <div class="input-group-append" data-target="#reservationdatetime"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="reason">Purpose Of Travel<span class="text-danger">*</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="reason"
                                        id="reason">
                                        <option value="">Select Purpose Of Travel</option>
                                        <option value="Meeting with Client"
                                            {{ $query->reason == 'Meeting with Client' ? 'selected' : '' }}>Meeting
                                            with Client</option>
                                        <option value="MBR/QBR" {{ $query->reason == 'MBR/QBR' ? 'selected' : '' }}>
                                            MBR/QBR</option>
                                        <option value="Resolution of an issue with client"
                                            {{ $query->reason == 'Resolution of an issue with client' ? 'selected' : '' }}>
                                            Resolution of an issue with client</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Process<span class="text-danger">*</span></label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="process"
                                        id="process">
                                        <option value="">Select Your Process</option>
                                        @foreach ($process as $key => $process)
                                            <option
                                                value="{{ $process }}"@if ($process == $query->process) selected @endif>
                                                {{ $process }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Accommodation<span class="text-danger">*</span></label>
                                    <div class="form-group clearfix">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" value="Yes" id="radio1" name="accomodation"
                                                {{ $query->accomodation == 'Yes' ? 'checked' : '' }}>
                                            <label for="radio1">Yes</label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" value="No" id="radio2" name="accomodation"
                                                {{ $query->accomodation == 'No' ? 'checked' : '' }}>
                                            <label for="radio2">No</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>No. Of Days<span class="text-danger">*</span></label>
                                    <input name="days_required" type="number" class="form-control"
                                        id="days_required" max="999" value="{{ $query->days_required }}">
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Advance Required<span class="text-danger">*</span></label>
                                    <div class="form-group clearfix">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="radioPrimary1" name="advance_required"
                                                {{ $query->advance_required == 'Yes' ? 'checked' : '' }}
                                                value="Yes">
                                            <label for="radioPrimary1">Yes
                                            </label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" id="radioPrimary2" name="advance_required"
                                                value="No"
                                                {{ $query->advance_required == 'No' ? 'checked' : '' }}>
                                            <label for="radioPrimary2">No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- @if ($query->advance_required == 'Yes') --}}
                            <div class="col-md-4">
                                <div class="form-group" id="amount_div">
                                    <label>Advance Amount<span class="text-danger">*</span></label>
                                    <input name="amount" type="number" class="form-control" id="amount"
                                        value="{{ $query->amount }}">
                                </div>
                            </div>
                            {{-- @endif --}}


                        </div>

                        <div class="card-footer">
                            <button onclick="" name="submit" type="submit"
                                class="btn btn-success">Update</button>
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


<!-- /.content -->

<script>
    $(function() {


        var advanced = '{{ $query->advance_required }}';
        if (advanced == 'No') {
            $('#amount_div').hide();
        } else {
            $('#amount_div').show();
        }

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

<script>
    $(function() {
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $('.select2bs4Edit').select2({
            theme: 'bootstrap4'
        })
        $('.select2bs4Create').select2({
            theme: 'bootstrap4'
        })
    });
</script>
