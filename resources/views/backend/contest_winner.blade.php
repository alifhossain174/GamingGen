@extends('backend.master')

@section('header_css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
@endsection

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
                                      
                                        <select class="form-control" id="contest_id" name="contest_id">

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
                                    <table class="custom_table" id="myCustomtable">
                                        

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
                                        <td>{{$item->position == 4?'Zero':$item->position}}</td>
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
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
{{-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script> --}}

<script>
    $(document).ready( function () {
        $('#myTable').dataTable( {
            "pageLength": 15,
        } );
    } );
</script>


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


<script type="text/javascript">
    $(document).ready(function() {
    $('#contest_id').on('change', function() {
        var contest_id = $(this).val();
            if(contest_id) {
                $.ajax({
                    url: '/find/contest/subscribers/'+contest_id,
                    type: "GET",
                  
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                      traditional: true,
                    success:function(data) {
                         console.log(data);
                        if(data){
                            $("#myCustomtable").html(data);
                            // $('#contest_id').empty();
                            // $('#contest_id').focus;
                            // $('#contest_id').append('<option value="">Select Contest</option>');
                            // $.each(data, function(key, value){
                            //     $('select[name="contest_id"]').append('<option value="'+ value.id +'">' + value.title+ '</option>');
                            // });
                        }
                        else{
                            $('#contest_id').empty();
                        }
                    }
                });
            }
            else{
                $('#contest_id').empty();
            }
        });
    });
</script>

  <!--<script type="text/javascript">  -->
  <!--      $(document).ready(function () {  -->
  <!--          $('#myCustomtable').DataTable({  -->
  <!--              "ajax": {  -->
  <!--                  "url": "/find/contest/subscribers/",  -->
  <!--                  "type": "GET",  -->
  <!--                  "datatype": "json"  -->
  <!--              },  -->
  <!--              "columns": [  -->
  <!--                  { "data": "Name" },  -->
  <!--                  { "data": "Email" },  -->
  <!--                    { "data": "Phone" }, -->
  <!--                      { "data": "Position" }, -->
  <!--                  { "data": "Kill" }  -->
  <!--              ]  -->
  <!--          });  -->
  <!--      });           -->
  <!--  </script>-->
@endsection

