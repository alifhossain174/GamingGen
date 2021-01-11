@extends('backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header text-white bg-success">
                        <b>View All Contest Rating</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Contest Title</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Star</th>
                                    <th scope="col">Comments</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=1; ?>
                                @foreach ($contest_ratings as $index => $item)
                                    <tr>
                                        <td>{{ $index+$contest_ratings->firstItem() }}</td>
                                        <td>
                                            @php
                                                $newDate = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d M, Y');
                                                echo $newDate;
                                            @endphp
                                        </td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->user_name}}</td>
                                        <td>{{$item->star}}</td>
                                        <td>{{$item->comments}}</td>
                                        <td>
                                            <a href="{{url('/delete/contest/rating')}}/{{$item->id}}" class="btn btn-danger btn-sm rounded"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $contest_ratings->links() }}
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


