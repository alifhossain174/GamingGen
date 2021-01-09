@extends('backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="card mt-3">
                    <div class="card-header bg-success text-white">
                        <b>Add New Contest</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <form action="{{url('/add/new/contest')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Select Game</label>
                                        <select class="form-control" name="game_id" required>
                                            <option>Select One</option>
                                            @foreach ($games as $item)
                                                <option value="{{$item->id}}">{{$item->game_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Game Code</label>
                                        <input type="text" name="game_code" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Contest Name</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Contest Date</label>
                                        <input type="date" name="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Contest Date</label>
                                        <input type="time" name="time" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Subscription Amount</label>
                                        <input type="text" name="amount" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Contest Prize</label>
                                        <input type="text" name="first" placeholder="First Prize" class="form-control" required>
                                        <input type="text" name="second" placeholder="Second Prize" class="form-control" required>
                                        <input type="text" name="third" placeholder="Third Prize" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Total Participants</label>
                                        <input type="text" name="participants" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="submit" value="Add Contest" class="btn btn-success rounded">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card mt-3">
                    <div class="card-header text-white bg-success">
                        <b>View All Contests</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <table class="table table-striped table-responsive" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Game</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Prize</th>
                                    <th scope="col">Participants</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=1; ?>
                                @foreach ($contests as $index => $item)
                                    <tr>
                                        <td>{{ $index+$contests->firstItem() }}</td>
                                        <td>{{$item->game_name}}</td>
                                        <td>{{$item->game_code}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->date}}</td>
                                        <td>{{$item->time}}</td>
                                        <td>{{$item->amount}}</td>
                                        <td>1st:{{$item->first}}<br>2nd:{{$item->second}}<br>3rd:{{$item->third}}</td>
                                        <td>{{$item->participants}}</td>
                                        <td>@if($item->status == 1) <span class="text-success">Active</span> @endif</td>
                                        <td>
                                            <a href="{{url('/delete/trend')}}/{{$item->id}}" class="btn btn-danger btn-sm rounded"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $contests->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

