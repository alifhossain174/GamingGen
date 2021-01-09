@extends('backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mt-3">
                    <div class="card-header bg-success text-white">
                        <b>Add New Game</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <form action="{{url('/add/new/game')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Game Name</label>
                                        <input type="text" name="game_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Package Name</label>
                                        <input type="text" name="package_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Upload Logo</label>
                                        <input type="file" name="logo" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" class="form-control" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG" required>
                                        <img id="blah2" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="submit" value="Save Game" class="btn btn-success rounded">
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
                        <b>View All Games</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th>Logo</th>
                                    <th scope="col">Game Name</th>
                                    <th scope="col">Package Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=1; ?>
                                @foreach ($games as $index => $item)
                                    <tr>
                                        <td>{{ $index+$games->firstItem() }}</td>
                                        <td><img src="{{url($item->logo)}}" style="width: 70px"></td>
                                        <td>{{$item->game_name}}</td>
                                        <td>{{$item->package_name}}</td>
                                        <td>
                                            <a href="{{url('/delete/game')}}/{{$item->id}}" class="btn btn-danger btn-md rounded">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $games->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

