@extends('backend.master')

@section('header_css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header text-white bg-success">
                        <b>View All Users</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <table class="table table-striped table-responsive display nowrap" id="myTable" style="width:100%">

                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Profession</th>
                                    <th scope="col">Institute</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl = 1; ?>
                                @foreach ($users as $item)
                                <tr>
                                    <th scope="row">{{$sl}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->department}}</td>
                                    <td>{{$item->semester}}</td>
                                    <td>{{$item->profession}}</td>
                                    <td>{{$item->details}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>
                                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$item->id}}" data-original-title="Edit" class="edit btn btn-success btn-sm rounded mt-1 editProduct"><i class="far fa-eye"></i></a>
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Department</th>
                                    <th>Semester</th>
                                    <th>Profession</th>
                                    <th>Institute</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>

                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="product_id" id="product_id">

                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Existing Project Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="existing_title" name="existing_title" placeholder="Enter Title" value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Project Period</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="existing_period" name="existing_period" placeholder="Enter Period" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Year</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="year" name="year" placeholder="Enter Year" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Project Donor</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="existing_donar" name="existing_donar" placeholder="Donor" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Project Budget</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="total_baget" name="total_baget" placeholder="Budget" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Project Location</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Thematic Area</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="thematic_area" name="thematic_area" placeholder="Thematic Area" value="">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_js')
    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#myTable').dataTable( {
                // "pageLength": 15,
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ]
            } );
        } );
    </script>

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $.get("{{ url('/get/existing/project/data/for/modal') }}" +'/' + product_id +'/edit', function (data) {
                    $('#modelHeading').html("Edit Existing Project");
                    $('#saveBtn').val("Edit Project");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.id);
                    $('#existing_title').val(data.existing_title);
                    $('#existing_period').val(data.existing_period);
                    $('#year').val(data.year);
                    $('#existing_donar').val(data.existing_donar);
                    $('#total_baget').val(data.total_baget);
                    $('#location').val(data.location);
                    $('#thematic_area').val(data.thematic_area);
                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Updating..');
                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ url('/save/modal/data/existing/project') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        location.reload(true);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

        });
    </script>
@endsection
