@extends('backend.master')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header text-white bg-success">
                        <b>View All Contests</b>
                    </div>
                    <div class="card-body" style="border-left: 1px solid #ADBC7A !important; border-bottom: 1px solid #ADBC7A !important;">
                        <table class="table table-striped table-responsive" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Game</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Prize</th>
                                    <th scope="col">Participants</th>
                                    <th scope="col">Joining Link</th>
                                    <th scope="col">Room No</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sl=1; ?>
                                @foreach ($contests as $index => $item)
                                    <tr>
                                        <td>{{ $index+$contests->firstItem() }}</td>
                                        <td>{{$item->game_name}}</td>
                                        <td>{{$item->game_code}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->date}}</td>
                                        <td>{{$item->time}}</td>
                                        <td>{{$item->amount}}</td>
                                        <td>1st:{{$item->first}}<br>2nd:{{$item->second}}<br>3rd:{{$item->third}}</td>
                                        <td>{{$item->participants}}</td>
                                        <td>{{$item->joining_link}}</td>
                                        <td>{{$item->room_no}}</td>
                                        <td>@php echo substr($item->description,0,20)."......" @endphp</td>
                                        <td>@if($item->status == 1) <span class="text-success">Active</span> @endif</td>
                                        <td>
                                            <a href="{{url('/delete/contest')}}/{{$item->id}}" class="btn btn-danger btn-sm mb-1 mr-1 rounded"><i class="far fa-trash-alt"></i></a>
                                            <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$item->id}}" data-original-title="Edit" class="edit btn btn-warning btn-sm mb-1 mr-1 rounded editProduct"><i class="far fa-edit"></i></a>
                                            @if($item->close == 0)
                                                <a href="{{url('/close/contest')}}/{{$item->id}}" class="btn btn-danger btn-sm mb-1 mr-1 rounded">Close</a>
                                            @else
                                                <a href="{{url('/open/contest')}}/{{$item->id}}" class="btn btn-success btn-sm mb-1 mr-1 rounded">Open</a>
                                            @endif
                                            @if($item->status == 1)
                                                <a href="{{url('/end/contest')}}/{{$item->id}}" class="btn btn-info btn-sm mb-1 mr-1 rounded">End</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $contests->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>

                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="contest_id" id="contest_id">

                        <div class="form-group">
                            <label for="phone" class="col-sm-12 control-label">Games</label>
                            <div class="col-sm-12">
                                <div id="game_id">

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="payment_method" class="col-sm-12 control-label">Game Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="game_code" name="game_code" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="amount" class="col-sm-12 control-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title" name="title" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-sm-12 control-label">Date</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="date" name="date" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="refference_no" class="col-sm-12 control-label">Time</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="time" name="time" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="transaction_id" class="col-sm-12 control-label">Amount</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="amount" name="amount" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="transaction_id" class="col-sm-12 control-label">Participants</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="participants" name="participants" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="transaction_id" class="col-sm-12 control-label">Joining Link</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="joining_link" name="joining_link" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="transaction_id" class="col-sm-12 control-label">Room No</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="room_no" name="room_no" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="transaction_id" class="col-sm-12 control-label">Short Description</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="description" name="description" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="refference_no" class="col-sm-12 control-label">Contest Prize</label>
                            <div class="col-sm-12">
                                <input type="text" name="first" id="first" placeholder="First Prize" class="form-control" required>
                                <input type="text" name="second" id="second" placeholder="Second Prize" class="form-control" required>
                                <input type="text" name="third" id="third" placeholder="Third Prize" class="form-control" required>
                            </div>
                        </div>


                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection




@section('footer_js')

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $.get("{{ url('/get/contest/data/for/modal') }}" +'/' + product_id +'/edit', function (data) {
                    // console.log(data.data.id);
                    $('#modelHeading').html("Edit Contest");
                    $('#saveBtn').val("Update");
                    $('#ajaxModel').modal('show');
                    $('#contest_id').val(data.data.id);
                    $('#game_id').html(data.select_options);
                    $('#game_code').val(data.data.game_code);
                    $('#title').val(data.data.title);
                    $('#date').val(data.data.date);
                    $('#time').val(data.data.time);
                    $('#amount').val(data.data.amount);
                    $('#participants').val(data.data.participants);
                    $('#joining_link').val(data.data.joining_link);
                    $('#room_no').val(data.data.room_no);
                    $('#description').val(data.data.description);
                    $('#first').val(data.data.first);
                    $('#second').val(data.data.second);
                    $('#third').val(data.data.third);

                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Updating..');
                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ url('/update/contest/data/by/modal') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        location.reload(true);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

        });
    </script>
@endsection

