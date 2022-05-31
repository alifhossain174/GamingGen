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
                        <div class="row">
                            <div class="col-lg-6">
                                <b>View All Withdraw Requests</b>
                            </div>
                            <div class="col-lg-6 text-right">
                                <form action="{{url('/filter/by/date/withdraw')}}" method="POST">
                                    @csrf
                                    From : <input type="date" name="start_date"> To : <input type="date" name="end_date">
                                    <input type="submit" value="Filter" class="btn btn-sm btn-info rounded">
                                </form>
                                
                                <form action="{{url('/filter/by/name/withdraw')}}" method="POST">
                                    @csrf
                                    Name : <input type="text" name="name">
                                    <input type="submit" value="Filter" class="btn btn-sm btn-info rounded">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Customer Phone</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Refference</th>
                                    <th scope="col">Transaction ID</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=1; ?>
                                @foreach ($withdraws as $index => $item)
                                    <tr>
                                        <td>{{ $index+$withdraws->firstItem() }}</td>
                                        <td>
                                            @php
                                                $newDate = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d M, Y');
                                            @endphp
                                            {{$newDate}}
                                        </td>
                                        <td>{{$item->user_name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->customer_number}}</td>
                                        <td>{{$item->amount}}</td>
                                        <td>{{$item->refference_no}}</td>
                                        <td>{{$item->transaction_id}}</td>
                                        <td>
                                            @if($item->status == 0)
                                            Pending
                                            @elseif($item->status == 1)
                                            <span class="text-success">Approved</span>
                                            @else
                                            <span class="text-danger">Denied</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/delete/withdraw')}}/{{$item->id}}" class="btn btn-danger btn-sm rounded"><i class="far fa-trash-alt"></i></a>
                                            @if($item->status == 0)
                                                <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$item->id}}" data-original-title="Approve" class="edit btn btn-success btn-sm rounded editProduct">Approve</a>
                                                <a href="{{url('/deny/withdraw')}}/{{$item->id}}/{{$item->user_id}}" class="btn btn-warning btn-sm rounded">Deny</a>

                                            @endif
                                            <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$item->id}}" data-original-title="edit" class="edit btn btn-info btn-sm rounded editWithDraw"><i class="far fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $withdraws->links() }}
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
                        <input type="hidden" name="user_id" id="user_id">

                        <div class="form-group">
                            <label for="phone" class="col-sm-12 control-label">Customer Number</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="customer_number" name="customer_number" placeholder="Customer Number" value="" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="payment_method" class="col-sm-12 control-label">Payment Method</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="payment_method" name="payment_method" placeholder="Payment Method" value="" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="amount" class="col-sm-12 control-label">Amount</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" value="" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-sm-12 control-label">Phone No</label>
                            <div class="col-sm-12">
                                <div id="phone">

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="refference_no" class="col-sm-12 control-label">Refference No</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="refference_no" name="refference_no" placeholder="Refference_no" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="transaction_id" class="col-sm-12 control-label">Transaction ID</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="transaction_id" name="transaction_id" placeholder="Transaction ID" value="">
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

    <div class="modal fade" id="ajaxModel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading2"></h4>
                </div>

                <div class="modal-body">
                    <form id="productForm2" name="productForm" class="form-horizontal">
                        <input type="hidden" name="product_id" id="product_id2">

                        <div class="form-group">
                            <label for="phone" class="col-sm-12 control-label">Customer Number</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="customer_number2" name="customer_number" placeholder="Customer Number" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="payment_method" class="col-sm-12 control-label">Payment Method</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="payment_method2" name="payment_method" placeholder="Payment Method" value="" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="amount" class="col-sm-12 control-label">Amount</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="amount2" name="amount" placeholder="Amount" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-sm-12 control-label">Phone No</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="phone2" name="phone" placeholder="Phone" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="refference_no" class="col-sm-12 control-label">Refference No</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="refference_no2" name="refference_no" placeholder="Refference_no" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="transaction_id" class="col-sm-12 control-label">Transaction ID</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="transaction_id2" name="transaction_id" placeholder="Transaction ID" value="">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn2" value="create">Save changes</button>
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
                $.get("{{ url('/get/withdraw/data/for/modal') }}" +'/' + product_id +'/edit', function (data) {
                    // console.log(data.data.id);
                    $('#modelHeading').html("Approve Withdraw");
                    $('#saveBtn').val("Approve");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.data.id);
                    $('#user_id').val(data.data.user_id);
                    $('#customer_number').val(data.data.customer_number);
                    $('#payment_method').val(data.data.payment_method);
                    $('#amount').val(data.data.amount);
                    $('#refference_no').val(data.data.refference_no);
                    $('#transaction_id').val(data.data.transaction_id);
                    $('#phone').html(data.select_options);
                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Updating..');
                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ url('/save/approve/data/wihdraw') }}",
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


        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.editWithDraw', function () {
                var product_id = $(this).data('id');
                $.get("{{ url('/get/withdraw/data/for/modal') }}" +'/' + product_id +'/edit', function (data) {
                    // console.log(data.data.phone);
                    $('#modelHeading2').html("Edit Withdraw");
                    $('#saveBtn2').val("Update");
                    $('#ajaxModel2').modal('show');
                    $('#product_id2').val(data.data.id);
                    $('#customer_number2').val(data.data.customer_number);
                    $('#payment_method2').val(data.data.payment_method);
                    $('#amount2').val(data.data.amount);
                    $('#refference_no2').val(data.data.refference_no);
                    $('#transaction_id2').val(data.data.transaction_id);
                    $('#phone2').val(data.data.phone);
                })
            });

            $('#saveBtn2').click(function (e) {
                e.preventDefault();
                $(this).html('Updating..');
                $.ajax({
                    data: $('#productForm2').serialize(),
                    url: "{{ url('/update/wihdraw/data/by/modal') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#productForm2').trigger("reset");
                        $('#ajaxModel2').modal('hide');
                        location.reload(true);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn2').html('Save Changes');
                    }
                });
            });

            });
    </script>
@endsection

