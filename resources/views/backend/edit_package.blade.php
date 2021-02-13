@extends('backend.master')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card mt-3">
                    <div class="card-header bg-success text-white">
                        <b>Edit Package</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <form action="{{url('/update/package')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="package_id" value="{{$data->id}}" readonly>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Select Game</label>
                                        <select class="form-control" name="game_id" required>
                                            <option>Select One</option>
                                            @foreach ($games as $item)
                                                @if($data->game_id == $item->id)
                                                    <option value="{{$item->id}}" selected>{{$item->game_name}}</option>
                                                @else
                                                    <option value="{{$item->id}}">{{$item->game_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" value="{{$data->title}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" name="amount" value="{{$data->amount}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Diamond</label>
                                        <input type="text" name="diamond" value="{{$data->diamond}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Upload Image</label>
                                        <input type="file" name="image" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" class="form-control" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG">
                                        <img id="blah2" alt="" class="img-fluid">
                                        <br>
                                        <b>Previous Image :</b>
                                        <img src="{{url($data->image)}}" id="prev_image" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="submit" value="Update Package" class="btn btn-success rounded">
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

