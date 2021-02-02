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
                                        @if($item->ban != 1)
                                        <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$item->id}}" data-original-title="Edit" class="edit btn btn-danger btn-sm rounded mt-1 editProduct"><i class="fas fa-times"></i></a>
                                        @endif
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
                        <input type="hidden" name="user_id" id="user_id">

                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Ban User For</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ban_day" name="ban_day" placeholder="Days" value="" required="">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Ban User</button>
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
                // $.get("{{ url('/get/existing/project/data/for/modal') }}" +'/' + product_id +'/edit', function (data) {
                    $('#modelHeading').html("Ban User");
                    $('#saveBtn').val("Edit Project");
                    $('#ajaxModel').modal('show');
                    $('#user_id').val(product_id);
                // })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Updating..');
                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ url('/make/user/banned') }}",
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
