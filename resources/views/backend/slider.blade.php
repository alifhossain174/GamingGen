@extends('backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mt-3">
                    <div class="card-header bg-success text-white">
                        <b>Add New Slider</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <form action="{{url('/add/new/slider')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Upload Image</label>
                                        <input type="file" name="image" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" class="form-control" accept=".png, .jpg, .jpeg ,.svg, .JPG, .PNG" required>
                                        <img id="blah2" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="submit" value="Save Slider" class="btn btn-success rounded">
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
                        <b>View All Sliders</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=1; ?>
                                @foreach ($sliders as $index => $item)
                                    <tr>
                                        <td>{{ $index+$sliders->firstItem() }}</td>
                                        <td><img src="{{url($item->image)}}" style="width: 70px"></td>
                                        <td>
                                            <a href="{{url('/delete/slider')}}/{{$item->id}}" class="btn btn-danger btn-md rounded">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $sliders->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

