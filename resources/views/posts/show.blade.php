@extends('layouts.app')

@section('content')

    <div class="container">
        <form id="postform">
            @csrf
            <div class="card">
                {{--
                            <img class="card-img-top" src="..." alt="Card image cap">
                --}}

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <h3 class="card-title">{{$post[0]->title}}</h3>
                        </div>
                        <div class="col-sm">
                            <ul class="list-inline">
                                <li class="list-inline-item"> By : {{$post[0]->name}}</li>
                                <li class="list-inline-item">| Gender : {{$post[0]->gender}}</li>
                                <li class="list-inline-item">| Posted on : {{$post[0]->created_at}}</li>

                            </ul>
                        </div>

                    </div>
                    <p class="card-text">
                        {{$post[0]->body}}

                    </p>
                    <div class="row-sm">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#myModal">Edit
                        </button>&nbsp;
                        <button type="button" id="deletepost"
                                class="btn btn-outline-danger">Delete
                        </button>
                    </div>
                    <br>

                    <div class="card text-white bg-primary mb-3" style="max-width: 40rem;">
                        <div class="card-header">
                            Add comment
                        </div>
                        <div class="card-body">
                            <div class="row-sm">
                                <input type="hidden" id="post_id" value="{{$post[0]->id}}">
                                <input type="hidden" id="user_id"
                                       value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                <textarea class="form-control z-depth-1" id="comment" rows="3"
                                          placeholder="Write comment ..."></textarea><br>
                                <button type="button" class="btn btn-success" id="sharecomment">Share</button>
                            </div>

                        </div>
                    </div>

                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-header">
                            Comments
                        </div>
                        <div class="card-body">

                            @foreach($comments as $comment)
                                <div class="card text-dark bg-light mb-3">
                                    <div class="card-header">By : {{$comment->name}} | Posted on : {{$comment->created_at}}</div>
                                    <div class="card-body">
                                        <p class="card-text">{{$comment->comment}}</p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
            <br>

            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Update post</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-8 col-md-offset-2">


                                    <div class="form-group">
                                        <label for="title">Title <span class="require">*</span></label>
                                        <input type="text" value="{{$post[0]->title}}" class="form-control" id="title" name="title" required autofocus/>
                                    </div>

                                    <div class="form-group">
                                        <label for="body">Body<span class="require">*</span></label>
                                        <textarea rows="5" class="form-control" id="body" name="body" required
                                                  autofocus>{{$post[0]->body}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <p><span class="require">*</span> - required fields</p>
                                    </div>



                                </div>
                            </div>

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" id="updatepost"
                                    class="btn btn-outline-success" >Update</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">

        jQuery(document).ready(function () {
            jQuery('#sharecomment').click(function (e) {
                e.preventDefault();
                jQuery.ajax({
                    url: "{{ url('/comments/store') }}",
                    method: 'post',
                    data: {
                        comment: jQuery('#comment').val(),
                        post_id: jQuery('#post_id').val(),
                        user_id: jQuery('#user_id').val(),
                        _token: '{{csrf_token()}}'
                    },
                    success: function (result) {
                        console.log(result);
                        window.location.reload();
                    }
                });
            });


            jQuery('#deletepost').click(function (e) {

                if (!confirm("Are You Sure to delete the post and it's comments?")) {
                    return;
                }

                e.preventDefault();
                var postid = jQuery('#post_id').val();

                // var el='<input name="_method" type="hidden" value="DELETE">';
                //$('#postform').append(el);
                jQuery.ajax({
                    url: "{{ url('/posts/delete') }}" + '/' + postid,
                    type: 'delete',
                    data: {
                        _method: 'DELETE',
                        _token: '{{csrf_token()}}'
                    },
                    success: function (result) {
                        console.log(result);
                        window.location.href = "/home";
                        //window.location.reload();
                    }
                });

            });
           /* jQuery("#myModal").validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 0
                    },
                    action: "required"
                },
                messages: {
                    body: {
                        required: "Please enter some data",
                        minlength: 65000
                    },
                    action: "Please provide some data"
                }
            });*/
            jQuery('#updatepost').click(function (e) {

                var postid = jQuery('#post_id').val();
                e.preventDefault();
                jQuery.ajax({
                    url: "{{ url('/posts/update') }}" + '/' + postid,
                    type: 'put',
                    data: {
                        title: jQuery('#title').val(),
                        body: jQuery('#body').val(),
                        _token: '{{csrf_token()}}'
                    },
                    success: function (result) {
                        console.log(result);
                        jQuery('#myModal').modal('toggle');
                        window.location.reload();
                    }
                });
            });
        });
    </script>
@endsection
