@extends('backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header text-white bg-success">
                        <div class="row">
                            <div class="col-lg-6">
                                <b>View All Contest Subscribers</b>
                            </div>
                            <div class="col-lg-6 text-right">
                                @php
                                    $contests = App\Contest::all();
                                @endphp
                                <form action="{{url('/filter/by/contest')}}" method="POST">
                                    @csrf
                                    <select name="contest_id">
                                        <option value="">Select One</option>
                                        @foreach ($contests as $item)
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit" value="Filter By Contest" class="btn btn-sm btn-info rounded">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Contest</th>
                                    <th scope="col">Game</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=1; ?>
                                @foreach ($contest_subscribers as $index => $item)
                                    <tr>
                                        <td>{{ $index+$contest_subscribers->firstItem() }}</td>
                                        <td>{{$item->contest_title}}</td>
                                        <td>{{$item->game_name}}</td>
                                        <td>{{$item->user_name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->password}}</td>
                                        <td>{{$item->date}}</td>
                                        <td>{{$item->time}}</td>
                                        <td>{{$item->amount}}</td>
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
                                            <a href="{{url('/delete/contest/subscriber')}}/{{$item->id}}" class="btn btn-danger btn-sm mt-1 rounded"><i class="far fa-trash-alt"></i></a>
                                            @if($item->status == 0)
                                                <a href="{{url('/approve/contest/subscriber')}}/{{$item->id}}" class="btn btn-success btn-sm mt-1 rounded">Approve</a>
                                                <a href="{{url('/deny/contest/subscriber')}}/{{$item->id}}" class="btn btn-warning btn-sm mt-1 rounded">Deny</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $contest_subscribers->links() }}
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


