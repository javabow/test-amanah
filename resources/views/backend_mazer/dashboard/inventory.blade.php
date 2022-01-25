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
                Inventory Table
            </div>
            <div class="button" style="padding: 10px;">
                <a href="#" class="btn btn-primary" style="float: right;padding: 10px" data-bs-toggle="modal"
                    data-bs-target="#inventoryModalAdd">New +</a>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Nama Barang</th>
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

    <!-- Vertically purchase modal Modal -->
    <div class="modal fade" id="purchaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form action="#" method="post" id="form_inventory_purchase" class="form_inventory_purchase">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Purchase Stock Item
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <label for="purchase_stok">Purchase Stock</label>
                                <input type="number" class="form-control" id="purchase_stok" name="purchase_stok"
                                    placeholder="Number of Purchased Stock" value=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="id_barang" name="id_barang">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Purchase</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Vertically purchase modal Modal -->

    <!-- Vertically delete modal Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form action="#" method="post" id="form_inventory_delete" class="form_inventory_delete">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Inventory
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <p>are you sure want to delete this data ?</p>
                            </div>
                            <input type="hidden" class="form-control" id="id_delete" name="id_delete">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Delete</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Vertically delete modal Modal -->

    <!-- Vertically event insert modal Modal -->
    <div class="modal fade" id="inventoryModalEdit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form action="#" method="post" id="form_inventory_edit" class="form_inventory_edit">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Inventory
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                    placeholder="Nama Barang" value="" required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga"
                                    placeholder="Harga Barang" value=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok Barang"
                                    value=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="id" name="id">
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
    <div class="modal fade" id="inventoryModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form action="#" method="post" class="form_event">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Inventory
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                    placeholder="Nama Barang" value="" required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga"
                                    placeholder="Harga Barang" value=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                                <div class="valid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    Valid
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok Barang"
                                    value=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script> --}}
    <script>
        // jQuery(function($) {
        //     $('#harga').autoNumeric('init');
        // });
        // $(document).ready(function() {

        //     var autoNumericInstance = new AutoNumeric('#harga', AutoNumeric.getPredefinedOptions().numericPos
        //         .dotDecimalCharCommaSeparator);

        //     $('#harga').on('keyup', function() {
        //         $('#harga').val(autoNumericInstance.getNumericString());
        //     });

        // });
    </script>

    {{-- <script src="{{ asset('backend_mazer/js/extensions/sweetalert2.js') }}"></script> --}}
    <script src="{{ asset('backend_mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).on('click', '.editBtn', function(e) {
            e.preventDefault();
            edit_id = $(this).attr("id");
            $.ajax({
                url: "{{ route('inventory_data_id') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    edit_id: edit_id
                },
                dataType: "json",
                success: function(data) {
                    // data = JSON.parse(response);
                    // $("#form_inventory_edit #location").val("Hello World!");
                    $(".form_inventory_edit input[name=nama_barang]").val(data.data[0].nama_barang);
                    $(".form_inventory_edit input[name=harga]").val(data.data[0].harga);
                    $(".form_inventory_edit input[name=stok]").val(data.data[0].stok);
                    $(".form_inventory_edit input[name=id]").val(data.data[0].id);
                    // $('.form_inventory_edit').find('').val(data.id)
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
        $(document).on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            delete_id = $(this).attr("id");
            $(".form_inventory_delete input[name=id_delete]").val(delete_id);
        });
    </script>
    <script>
        $(document).on('click', '.purchaseBtn', function(e) {
            e.preventDefault();
            purchase_id = $(this).attr("id");
            $(".form_inventory_purchase input[name=id_barang]").val(purchase_id);
        });
    </script>
    <script>
        // jQuery, bind an event handler or use some other way to trigger ajax call.
        $('.form_inventory_purchase').submit(function(event) {
            event.preventDefault();
            var table_event = $('#table1').DataTable();
            $.ajax({
                url: '{{ route('purchase_inventory_item') }}',
                type: 'post',
                data: $('.form_inventory_purchase')
                    .serialize(), // Remember that you need to have your csrf token included
                dataType: 'json',
                success: function(_response) {
                    Swal.fire({
                        icon: "success",
                        title: "Purchased and Stock Updated to database !"
                    })
                    $('#purchaseModal').modal('hide');
                    table_event.ajax.reload(null, false);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    Swal.fire({
                        icon: "error",
                        title: "Error trying to access data to database !"
                    })
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
                url: '{{ route('inventory_store') }}',
                type: 'post',
                data: $('.form_event')
                    .serialize(), // Remember that you need to have your csrf token included
                dataType: 'json',
                success: function(_response) {
                    // console.log(data);
                    Swal.fire({
                        icon: "success",
                        title: "added to database !"
                    })
                    $('#inventoryModalAdd').modal('hide');
                    table_event.ajax.reload(null, false);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    // console.log(xhr.status);
                    // console.log(thrownError);
                    Swal.fire({
                        icon: "error",
                        title: "Error trying to add data to database !"
                    })
                }
            });
        });
    </script>
    <script>
        // jQuery, bind an event handler or use some other way to trigger ajax call.
        $('.form_inventory_edit').submit(function(event) {
            event.preventDefault();
            var table_event = $('#table1').DataTable();
            $.ajax({
                url: '{{ route('inventory_update') }}',
                type: 'post',
                data: $('.form_inventory_edit')
                    .serialize(), // Remember that you need to have your csrf token included
                dataType: 'json',
                success: function(_response) {
                    // console.log(data);
                    Swal.fire({
                        icon: "success",
                        title: "Updated to database !"
                    })
                    $('#inventoryModalEdit').modal('hide');
                    table_event.ajax.reload(null, false);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    Swal.fire({
                        icon: "error",
                        title: "Error trying to edit data to database !"
                    })
                }
            });
        });
    </script>
    <script>
        // jQuery, bind an event handler or use some other way to trigger ajax call.
        $('.form_inventory_delete').submit(function(event) {
            event.preventDefault();
            var table_event = $('#table1').DataTable();
            $.ajax({
                url: '{{ route('inventory_delete') }}',
                type: 'post',
                data: $('.form_inventory_delete')
                    .serialize(), // Remember that you need to have your csrf token included
                dataType: 'json',
                success: function(_response) {
                    // console.log(data);
                    Swal.fire({
                        icon: "success",
                        title: "Deleted !"
                    })
                    $('#deleteModal').modal('hide');
                    table_event.ajax.reload(null, false);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    Swal.fire({
                        icon: "error",
                        title: "Error trying to delete data to database !"
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
                    "url": "{{ route('inventory_table') }}",
                    "type": "GET",
                    // "Authorization": "Bearer 3|Yk6ETwZFHz3gG8fah0KhNfuOw2EE38Nw2RGWwOzG"
                    // "crossDomain": false
                    // "headers": {
                    //     // 'X-Requested-With': 'XMLHttpRequest'
                    // }
                },

                columns: [

                    {
                        data: 'id',
                        name: 'id',
                        searchable: true,
                        width: "5%"
                    },

                    {
                        data: 'nama_barang',
                        name: 'nama_barang',
                        searchable: true
                    },

                    {
                        data: 'harga',
                        name: 'harga',
                        searchable: true
                    },

                    {
                        data: 'stok',
                        name: 'stok',
                        searchable: true,
                        width: "10%"
                    },

                    {
                        data: null,
                        width: "13%",
                        width: "20%",
                        render: function(data, type, row) {
                            // Combine the first and last names into a single table field
                            return '<div class="button" style="padding: 10px;"><a href="#" class="btn btn-danger deleteBtn" id=' +
                                data.id +
                                ' style="float: right;padding: 10px" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>' +
                                ' <a href="#" class="btn btn-info purchaseBtn" id=' +
                                data.id +
                                ' style="float: right;padding: 10px;margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#purchaseModal">Purchase</a></div>' +
                                ' <a href="#" class="btn btn-info editBtn" id=' +
                                data.id +
                                ' style="float: right;padding: 10px;margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#inventoryModalEdit">Edit</a></div>';
                        }
                    },
                ],
                initComplete: function() {
                    this.api().columns([1]).every(function() {
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
