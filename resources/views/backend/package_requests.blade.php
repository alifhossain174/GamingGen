@extends('backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header text-white bg-success">
                        <b>View All Package Requests</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Package</th>
                                    <th scope="col">Game</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">User Credential</th>
                                    <th scope="col" style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=1; ?>
                                @foreach ($package_requests as $index => $item)
                                    <tr>
                                        <td>{{ $index+$package_requests->firstItem() }}</td>
                                        <td>{{$item->package_title}}</td>
                                        <td>{{$item->game_name}}</td>
                                        <td>{{$item->user_name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->amount}}</td>
                                        <td>{{$item->username_email_contact}}</td>
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
                                            <a href="{{url('/delete/package/request')}}/{{$item->id}}" class="btn btn-danger btn-sm rounded"><i class="far fa-trash-alt"></i></a>
                                            @if($item->status == 0)
                                                <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$item->id}}" data-original-title="Approve" class="edit btn btn-success btn-sm rounded editProduct">Approve</a>
                                                <a href="{{url('/deny/package/request')}}/{{$item->id}}" class="btn btn-warning btn-sm rounded">Deny</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $package_requests->links() }}
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


