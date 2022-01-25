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
                Secret Number Input : 25834
            </div>
            <div class="card-body">
                <form action="#" method="post" id="form_secret" class="form_secret">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <label for="secret">Secret Number</label>
                            <input type="number" class="form-control" id="secret" name="secret"
                                placeholder="Input Secret Number" value=""
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                required>
                            <div class="valid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                Valid
                            </div>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4" style="padding-top: 20px;">
                            <button type="submit" class="btn btn-primary ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Check</span>
                            </button>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>




@endsection
@push('after-js')
    <script src="{{ asset('backend_mazer/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend_mazer/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend_mazer/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}">
        < script src = "{{ asset('backend_mazer/js/extensions/sweetalert2.js') }}" >
    </script>
    <script src="{{ asset('backend_mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}">
    </script>

    <script>
        // jQuery, bind an event handler or use some other way to trigger ajax call.
        $('.form_secret').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route('secret_check') }}',
                type: 'post',
                data: $('.form_secret')
                    .serialize(), // Remember that you need to have your csrf token included
                dataType: 'json',
                success: function(_response) {
                    console.log(_response);
                    Swal.fire({
                        icon: "success",
                        title: _response.alhamdulillah + " Alhamdulillah, " + _response
                            .subhanallah + " Subhanallah"
                    })
                    // $('#inventoryModalAdd').modal('hide');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    Swal.fire({
                        icon: "error",
                        title: "Error API !"
                    })
                }
            });
        });
    </script>

    <script src="{{ asset('backend_mazer/vendors/fontawesome/all.min.js') }}"></script>


    {{-- <script>
        // Jquery Datatable
        let jquery_datatable = $("#table1").DataTable()
    </script> --}}
@endpush
