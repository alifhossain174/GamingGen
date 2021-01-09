@extends('backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="card mt-3">
                    <div class="card-header bg-success text-white">
                        <b>Add Contest Winner</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <form action="{{url('/add/new/contest/winner')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Select Contest</label>
                                        <select class="form-control" name="contest_id" required>
                                            <option>Select One</option>
                                            @foreach ($contests as $item)
                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Winner Phone</label>
                                        <input type="text" name="country" id="generic" class="form-control" placeholder="Search By Contact" required>
                                        <div id="generic_list" style="position:relative;"></div>
                                        <div id="generic_id"></div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Winning Position</label>
                                        <select class="form-control" name="position" required>
                                            <option>Select One</option>
                                            <option value="1">1st</option>
                                            <option value="2">2nd</option>
                                            <option value="3">3rd</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <div class="form-group">
                                        <input type="submit" value="Set Winner" class="btn btn-success rounded">
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
                        <b>View All Winners</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Contest Name</th>
                                    <th scope="col">Game</th>
                                    <th scope="col">Winner</th>
                                    <th scope="col">Winner Image</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Prize</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=1; ?>
                                @foreach ($contest_winner as $index => $item)
                                    <tr>
                                        <td>{{ $index+$contest_winner->firstItem() }}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->game_name}}</td>
                                        <td>{{$item->user_name}}</td>
                                        <td><img src="{{url($item->user_image)}}" style="width: 55px"></td>
                                        <td>{{$item->position}}</td>
                                        <td>{{$item->winning_amount}}</td>
                                        <td>
                                            <a href="{{url('/delete/contest/winner')}}/{{$item->id}}/{{$item->contest_id}}" class="btn btn-danger btn-sm rounded"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $contest_winner->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection


@section('footer_js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#generic').on('keyup',function() {
            var query = $(this).val();
            $.ajax({
                url:"{{ url('search/customer/for/new/sale') }}",
                type:"GET",
                data:{'country':query},
                success:function (data) {
                    $('#generic_list').html(data);
                }
            })
        });

        $(document).on('click', 'li', function(){
            var value = $(this).text();
            $('#generic').val(value);
            $('#generic_list').html("");

            var query = $('#generic').val();
            $.ajax({
                url:"{{ url('customer/id/from/customer/name') }}",
                type:"GET",
                data:{'country':query},
                success:function (data) {
                    $('#generic_id').html(data);
                }
            })
        });
    });
</script>
@endsection

