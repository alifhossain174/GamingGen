@extends('backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card mt-3">
                    <div class="card-header bg-info text-white">
                        <b> Change Password</b>
                    </div>
                    <div class="card-body">
                        <form action="{{url('chnage/my/email')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" placeholder="Full Name" readonly>
                            </div>
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" placeholder="Email">
                            </div>
                           
                         
                            <div class="form-group text-center pt-2">
                                <input type="submit" value="Change Email" class="btn btn-success rounded">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

