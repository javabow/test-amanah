@extends('backend_mazer.layouts.master')
@push('after-style')
    <link rel="stylesheet"
        href="{{ asset('backend_mazer/vendors/jquery-datatables/jquery.dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('backend_mazer/vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush
@section('content')

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                Event Wedding Table
            </div>
            <div class="button" style="padding: 10px;">
                <a href="#" class="btn btn-primary" style="float: right;padding: 10px" data-bs-toggle="modal"
                    data-bs-target="#eventModalAdd">New +</a>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Location</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
    </div>

    <!-- Vertically event insert modal Modal -->
    <div class="modal fade" id="eventModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form action="#" method="post" id="form_event_edit" class="form_event_edit">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Event
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="Client">Client</label>
                                <input type="text" class="form-control" id="client" name="client" placeholder="Client ID"
                                    value="" required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="title_event">Judul Event</label>
                                <input type="text" class="form-control" id="title_event" name="title_event"
                                    placeholder="Event Title" value="" required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    placeholder="Wedding Location" value="" required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="start_event">Start Date</label>
                                <input data-provide="datepicker" class="form-control datepicker" id="start_event"
                                    name="start_event" placeholder="Start Date" value="" required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="end_event">End Date</label>
                                <input data-provide="datepicker" class="form-control datepicker" id="end_event"
                                    name="end_event" placeholder="End Date" value="" required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Vertically event insert modal Modal -->

    <!-- Vertically event insert modal Modal -->
    <div class="modal fade" id="eventModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form action="#" method="post" class="form_event">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Event
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="Client">Client</label>
                                <input type="text" class="form-control" id="client" name="client" placeholder="Client ID"
                                    value="" required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="title_event">Judul Event</label>
                                <input type="text" class="form-control" id="title_event" name="title_event"
                                    placeholder="Event Title" value="" required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    placeholder="Wedding Location" value="" required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="start_event">Start Date</label>
                                <input data-provide="datepicker" class="form-control datepicker" id="start_event"
                                    name="start_event" placeholder="Start Date" value="" required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="end_event">End Date</label>
                                <input data-provide="datepicker" class="form-control datepicker" id="end_event"
                                    name="end_event" placeholder="End Date" value="" required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Add</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Vertically event insert modal Modal -->


@endsection
@push('after-js')
    <script src="{{ asset('backend_mazer/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend_mazer/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend_mazer/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}">
    </script>
    {{-- <script src="{{ asset('backend_mazer/js/extensions/sweetalert2.js') }}"></script> --}}
    <script src="{{ asset('backend_mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).on('click', '.editBtn', function(e) {
            e.preventDefault();
            edit_id = $(this).attr("id");
            $.ajax({
                url: "{{ route('event_data_id') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    edit_id: edit_id
                },
                dataType: "json",
                success: function(data) {
                    // data = JSON.parse(response);
                    // $("#form_event_edit #location").val("Hello World!");
                    console.log(data.data[0].title);
                    $(".form_event_edit input[name=client]").val(data.data[0].client_id);
                    $(".form_event_edit input[name=title_event]").val(data.data[0].title);
                    $(".form_event_edit input[name=location]").val(data.data[0].location);
                    $(".form_event_edit input[name=start_event]").val(data.data[0].start_date);
                    $(".form_event_edit input[name=end_event]").val(data.data[0].end_date);
                    // $('.form_event_edit').find('').val(data.id)
                    // $('#id').val(data.id); //id name of the modal; the hidden type
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    // Swal.fire({
                    //     icon: "error",
                    //     title: "Error trying to add data event to database !"
                    // })
                }
            });
        });
    </script>
    <script>
        // jQuery, bind an event handler or use some other way to trigger ajax call.
        $('.form_event').submit(function(event) {
            event.preventDefault();
            var table_event = $('#table1').DataTable();
            $.ajax({
                url: '{{ route('event_store') }}',
                type: 'post',
                data: $('.form_event')
                    .serialize(), // Remember that you need to have your csrf token included
                dataType: 'json',
                success: function(_response) {
                    // console.log(data);
                    Swal.fire({
                        icon: "success",
                        title: "added to event database !"
                    })
                    $('#eventModalAdd').modal('hide');
                    table_event.ajax.reload(null, false);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    // console.log(xhr.status);
                    // console.log(thrownError);
                    Swal.fire({
                        icon: "error",
                        title: "Error trying to add data event to database !"
                    })
                }
            });
        });
    </script>
    <script>
        // jQuery, bind an event handler or use some other way to trigger ajax call.
        $('.form_event_edit').submit(function(event) {
            event.preventDefault();
            var table_event = $('#table1').DataTable();
            $.ajax({
                url: '{{ route('event_update') }}',
                type: 'post',
                data: $('.form_event_edit')
                    .serialize(), // Remember that you need to have your csrf token included
                dataType: 'json',
                success: function(_response) {
                    // console.log(data);
                    Swal.fire({
                        icon: "success",
                        title: "Event updated to database !"
                    })
                    $('#eventModalAdd').modal('hide');
                    table_event.ajax.reload(null, false);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    Swal.fire({
                        icon: "error",
                        title: "Error trying to add data event to database !"
                    })
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $('.datepicker').datepicker({
            format: 'yyyy/mm/dd',
            startDate: '1d'
        });
    </script>
    <script src="{{ asset('backend_mazer/vendors/fontawesome/all.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('#table1').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'print'
                ],
                processing: true,

                serverSide: true,
                pageLength: 25,
                lengthMenu: [5, 10, 25, 50, 100, 200, 500],
                // ajax: "http://127.0.0.1:8000/api/client/",

                "ajax": {
                    "url": "http://127.0.0.1:8000/api/event-list/",
                    "type": "GET",
                    // "Authorization": "Bearer 3|Yk6ETwZFHz3gG8fah0KhNfuOw2EE38Nw2RGWwOzG"
                    // "crossDomain": false
                    // "headers": {
                    //     // 'X-Requested-With': 'XMLHttpRequest'
                    // }
                },

                columns: [

                    {
                        data: 'client.name',
                        name: 'client.name',
                        searchable: true
                    },

                    {
                        data: 'title',
                        name: 'title',
                        searchable: true
                    },

                    {
                        data: 'location',
                        name: 'location',
                        searchable: true
                    },

                    {
                        data: 'start_date',
                        name: 'start_date',
                        searchable: true
                    },

                    {
                        data: 'end_date',
                        name: 'end_date',
                        searchable: true
                    },

                    {
                        data: null,
                        width: "13%",
                        render: function(data, type, row) {
                            // Combine the first and last names into a single table field
                            return '<div class="button" style="padding: 10px;"><a href="#" class="btn btn-danger editBtn" id=' +
                                data.id +
                                ' style="float: right;padding: 10px" data-bs-toggle="modal" data-bs-target="#">Delete</a>' +
                                ' <a href="#" class="btn btn-info editBtn" id=' +
                                data.id +
                                ' style="float: right;padding: 10px;margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#eventModalEdit">Edit</a></div>';
                        }
                    },
                ],
                initComplete: function() {
                    this.api().columns([2]).every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control"><option value="">All</option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                },
                "order": [
                    [3, 'desc']
                ],
                "columnDefs": [{
                    "targets": 3,
                    "type": "date"
                }]
            });



        });
    </script>

    {{-- <script>
        // Jquery Datatable
        let jquery_datatable = $("#table1").DataTable()
    </script> --}}
@endpush
