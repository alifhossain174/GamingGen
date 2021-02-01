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
                                    <th scope="col">Transaction ID</th>
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
                                            <a href="{{url('/delete/add/money')}}/{{$item->id}}" class="btn btn-danger btn-sm rounded"><i class="far fa-trash-alt"></i></a>
                                            @if($item->status == 0)
                                                <a href="{{url('/approve/add/money')}}/{{$item->id}}/{{$item->user_id}}" class="btn btn-success btn-sm rounded">Approve</a>
                                                <a href="{{url('/deny/add/money')}}/{{$item->id}}" class="btn btn-warning btn-sm rounded">Deny</a>
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

@endsection



