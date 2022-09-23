@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        {{ $post->updated_at->toFormattedDateString() }}
        @if ($post->published)
            <span class="label label-success" style="margin-left:15px;">Published</span>
        @else
            <span class="label label-default" style="margin-left:15px;">Draft</span>
        @endif
        <hr />
        <p class="lead">
            {{ $post->content }}
        </p>
        <hr />

        <h3>Comments:</h3>
        @if(auth()->user())
        <div style="margin-bottom:50px;">
            <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('posts/'.$post -> id.'/comment')}}">
                @csrf
                <div class="form-group">
                    <input type="text" id="body" name="body" class="form-control" required=""placeholder="Leave a comment">
                </div>

                <button type="submit" class="btn btn-primary">Comment</button>
            </form>
{{--            <textarea class="form-control" rows="3" name="body" placeholder="Leave a comment" ></textarea>--}}
{{--            <a id="checkout" href="{{url('posts/'.$post -> id.'/comment')}}"--}}
{{--               role="button" class="btn  btn-success px-3 waves-effect waves-light">Save Comment--}}
{{--            </a>--}}

        </div>
        @else
            <div><h3>
                    you must be logged in to submit a comment

                </h3>
                <a href="/login">log in now</a>
            </div>
        @endif
@if(isset($comments)&&$comments->count()>0)
@foreach($comments as $comment)
        <div  class="media" style="margin-top:20px;" >
            <div class="media-left">
                <a href="#">
                    <img class="media-object" src="http://placeimg.com/80/80" alt="...">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{$comment->user['name']}} said...</h4>
                <p>
                    {{$comment->body}}
                </p>
                <span style="color: #aaa;">on {{$comment->created_at}}</span>
            </div>
        </div>
    </div>
    @endforeach
@endsection
@endif





















{{--@section('scripts')--}}
{{--    <script>--}}

{{--        const app = new Vue({--}}
{{--            el: '#app',--}}
{{--            data: {--}}
{{--                comments: {},--}}
{{--                commentBox: '',--}}
{{--                post: {!! $post->toJson() !!},--}}
{{--                user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!}--}}
{{--            },--}}
{{--            mounted() {--}}
{{--                this.getComments();--}}
{{--            },--}}
{{--            methods: {--}}
{{--                getComments() {--}}
{{--                    axios.get('/api/posts/'+this.post.id+'/comments')--}}
{{--                        .then((response) => {--}}
{{--                            this.comments = response.data--}}
{{--                        })--}}
{{--                        .catch(function (error) {--}}
{{--                            console.log(error);--}}
{{--                        });--}}
{{--                },--}}
{{--                postComment() {--}}
{{--                    axios.post('/api/posts/'+this.post.id+'/comment', {--}}
{{--                        api_token: this.user.api_token,--}}
{{--                        body: this.commentBox--}}
{{--                    })--}}
{{--                        .then((response) => {--}}
{{--                            this.comments.unshift(response.data);--}}
{{--                            this.commentBox = '';--}}
{{--                        })--}}
{{--                        .catch((error) => {--}}
{{--                            console.log(error);--}}
{{--                        })--}}
{{--                }--}}
{{--            }--}}
{{--        })--}}

{{--    </script>--}}
{{--    <script>--}}
{{--      Echo.channel('post.'+this.post.id).listen('NewComment');--}}

{{--    </script>--}}
{{--@endsection--}}
