@extends('backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header text-white bg-success">
                        <b>View All Add Money Request</b>
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
                                    <th scope="col">TransactionID</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=1; ?>
                                @foreach ($add_moneys as $index => $item)
                                    <tr>
                                        <td>{{ $index+$add_moneys->firstItem() }}</td>
                                        <td>{{$item->created_at}}</td>
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
                                            Approved
                                            @else
                                            Denied
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/delete/add/money')}}/{{$item->id}}" class="btn btn-danger mb-1 btn-sm rounded"><i class="far fa-trash-alt"></i></a>
                                            @if($item->status == 0)
                                                <a href="{{url('/approve/add/money')}}/{{$item->id}}/{{$item->user_id}}" class="btn mb-1 btn-success btn-sm rounded">Approve</a>
                                                <a href="{{url('/deny/add/money')}}/{{$item->id}}" class="btn btn-warning btn-sm rounded">Deny</a>
                                                <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$item->id}}" data-original-title="Edit" class="edit btn btn-info btn-sm rounded editProduct"><i class="far fa-edit"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $add_moneys->links() }}
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
                        <input type="hidden" name="add_money_id" id="add_money_id">

                        <div class="form-group">
                            <label for="payment_method" class="col-sm-12 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" value="" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="amount" class="col-sm-12 control-label">Phone</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="phone" name="phone" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-sm-12 control-label">Customer Number</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="customer_number" name="customer_number" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="refference_no" class="col-sm-12 control-label">Payment Method</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="payment_method" name="payment_method" value="" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="transaction_id" class="col-sm-12 control-label">Amount</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="amount" name="amount" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="transaction_id" class="col-sm-12 control-label">Refference No</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="refference_no" name="refference_no" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="transaction_id" class="col-sm-12 control-label">Transaction ID</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="">
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

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $.get("{{ url('/get/add/money/data/for/modal') }}" +'/' + product_id +'/edit', function (data) {
                    $('#modelHeading').html("Edit Add Money");
                    $('#saveBtn').val("Update");
                    $('#ajaxModel').modal('show');
                    $('#add_money_id').val(data.id);
                    $('#name').val(data.user_name);
                    $('#phone').val(data.phone);
                    $('#customer_number').val(data.customer_number);
                    $('#payment_method').val(data.payment_method);
                    $('#amount').val(data.amount);
                    $('#refference_no').val(data.refference_no);
                    $('#transaction_id').val(data.transaction_id);

                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Updating..');
                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ url('/update/add/money/data/by/modal') }}",
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




