@extends('backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header bg-success text-white">
                        <b>Add New Contest</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <form action="{{url('/add/new/contest')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
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

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Game Code</label>
                                        <input type="text" name="game_code" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Contest Name</label>
                                        <input type="text" name="title" class="form-control" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Contest Date</label>
                                        <input type="date" name="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Contest Time</label>
                                        <input type="time" name="time" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Subscription Amount</label>
                                        <input type="text" name="amount" placeholder="Amount" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Total Participants</label>
                                        <input type="text" name="participants" placeholder="No of Participants" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Joining Link</label>
                                        <input type="text" name="joining_link" placeholder="Link" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Room No</label>
                                        <input type="text" name="room_no" class="form-control" placeholder="Room No" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Contest Prize</label>
                                        <input type="text" name="first" placeholder="First Prize" class="form-control" required>
                                        <input type="text" name="second" placeholder="Second Prize" class="form-control" required>
                                        <input type="text" name="third" placeholder="Third Prize" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea name="description" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group text-right">
                                        <input type="submit" value="Add Contest" class="btn btn-success rounded">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

