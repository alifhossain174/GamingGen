@extends('backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mt-3">
                    <div class="card-header bg-success text-white">
                        <b>Add New Trend</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <form action="{{url('/add/new/trend')}}" method="POST" enctype="multipart/form-data">
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
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Upload Image</label>
                                        <input type="file" name="image" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" class="form-control" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG" required>
                                        <img id="blah2" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="submit" value="Save Trend" class="btn btn-success rounded">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card mt-3">
                    <div class="card-header text-white bg-success">
                        <b>View All Trends</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th>Image</th>
                                    <th scope="col">Game</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=1; ?>
                                @foreach ($trends as $index => $item)
                                    <tr>
                                        <td>{{ $index+$trends->firstItem() }}</td>
                                        <td><img src="{{url($item->image)}}" style="width: 70px"></td>
                                        <td>{{$item->game_name}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>
                                            <a href="{{url('/edit/trend')}}/{{$item->id}}" class="btn btn-warning btn-sm rounded">Edit</a>
                                            <a href="{{url('/delete/trend')}}/{{$item->id}}" class="btn btn-danger btn-sm rounded">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $trends->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

