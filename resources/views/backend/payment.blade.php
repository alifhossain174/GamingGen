@extends('backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mt-3">
                    <div class="card-header bg-success text-white">
                        <b>Add New Payment</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <form action="{{url('/add/new/payment')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Select Type</label>
                                        <select class="form-control" name="type" required>
                                            <option>Select One</option>
                                            <option value="bkash">Bkash</option>
                                            <option value="rocket">Rocket</option>
                                            <option value="nagad">Nagad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Number</label>
                                        <input type="text" name="number" class="form-control" required>
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
                                        <input type="submit" value="Save Payment" class="btn btn-success rounded">
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
                        <b>View All Payments</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th>Type</th>
                                    <th scope="col">Number</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=1; ?>
                                @foreach ($payments as $index => $item)
                                    <tr>
                                        <td>{{ $index+$payments->firstItem() }}</td>
                                        <td>{{$item->type}}</td>
                                        <td>{{$item->number}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>
                                            <a href="{{url('/delete/payment')}}/{{$item->id}}" class="btn btn-danger btn-sm rounded">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $payments->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

