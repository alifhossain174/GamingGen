@extends('backend.master')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header bg-success text-white">
                        <b>Add Contest Winner</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <form action="{{url('/add/new/contest/winner')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Select Game</label>
                                        <select class="form-control" id="game_id" name="game_id" required>
                                            <option>Select Game</option>
                                            @foreach ($games as $item)
                                                <option value="{{$item->id}}">{{$item->game_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Select Contest</label>
                                        <select class="form-control" id="contest_id" name="contest_id" required>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">

                                </div>

                                <div class="col-lg-12">
                                    <style>
                                        table.custom_table ,table.custom_table tr td{
                                            border:1px solid gray;
                                            padding: 5px 5px
                                        }
                                        table.custom_table tbody {
                                            display:block;
                                            height:250px;
                                            overflow:auto;
                                        }
                                        table.custom_table thead,table.custom_table tbody tr {
                                            display:table;
                                            width:100%;
                                            table-layout:fixed;
                                        }
                                        table.custom_table thead {
                                            width: calc( 100% - 1em )
                                        }
                                        table.custom_table {
                                            width:100%;
                                        }
                                    </style>

                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Per Kill Amount :</label>
                                                <input type="text" name="per_kill_amount" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <label>Users List :</label>
                                    <table class="custom_table">
                                        <?php $sl=1;?>
                                        @foreach ($users as $item)
                                        <tr>
                                            <input type="hidden" name="user_id[]" value="{{$item->id}}">
                                            <td style="width: 5%"><?php echo $sl++; ?></td>
                                            <td style="width: 10%;text-align:center">@if($item->image != null)<img src="{{url($item->image)}}" class="img-fluid" style="overflow:hidden;width:60px">@endif</td>
                                            <td style="width: 20%">{{$item->name}}</td>
                                            <td style="width: 20%">{{$item->email}}</td>
                                            <td style="width: 15%">@if($item->phone != null){{$item->phone}}@endif</td>
                                            <td style="width: 15%">
                                                <select name="position[]" required>
                                                    <option value="0">Select One</option>
                                                    <option value="1">1st</option>
                                                    <option value="2">2nd</option>
                                                    <option value="3">3rd</option>
                                                </select>
                                            </td>
                                            <td style="width: 15%"><input type="text" name="kill[]" placeholder="No. of Kills" style="width: 90%" value=""></td>
                                        </tr>
                                        @endforeach
                                    </table>
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
        </div>

        <div class="row">
            {{--  <div class="col-lg-3">
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
            </div>  --}}

            <div class="col-lg-12">
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
                                    <th scope="col">Kill</th>
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
                                        <td>@if($item->user_image != null)<img src="{{url($item->user_image)}}" style="width: 55px">@endif</td>
                                        <td>{{$item->kill}}</td>
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
    $(document).ready(function() {
    $('#game_id').on('change', function() {
        var game_id = $(this).val();
            if(game_id) {
            $.ajax({
                url: '/find/contest/'+game_id,
                type: "GET",
                data : {"_token":"{{ csrf_token() }}"},
                dataType: "json",
                success:function(data) {
                    // console.log(data);
                    if(data){
                    $('#contest_id').empty();
                    $('#contest_id').focus;
                    $('#contest_id').append('<option value="">Select Contest</option>');
                    $.each(data, function(key, value){
                    $('select[name="contest_id"]').append('<option value="'+ value.id +'">' + value.title+ '</option>');
                });
                }else{
                $('#contest_id').empty();
                }
                }
            });
            }else{
            $('#contest_id').empty();
            }
        });
    });
</script>
@endsection

