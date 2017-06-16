@extends('layouts.app-admin')
@section('title', "| Blog")
@section('content')

<div class="container">


<div class="row">
  <div class="col-md-12" >
      <label class="col-sm-6" >{{ $blog->title }}</label>
      <div class="tags col-sm-6" style="margin: 10px;">
        <hr>
        @foreach($blog->tags as $tag)
          <span class="label label-default"> {{ $tag->name}}</span>
        @endforeach
        <hr>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">{!!$blog->text !!}</div>
</div>
<div class="row">
     <div class="col-md-8 col-md-offset-2" style="margin: 10px;">
        <hr>
        <h3><span class="
glyphicon glyphicon-comment"></span> Comments</h3>
        @foreach($blog->comments as $comment)
          <div class="comment">
              <div class = "author-info">
                <img src="{{ "https://www.gravatar.com/avatar/" .md5(strtolower(trim($comment->email))) . "?s=50&d=monsterid" }}" class="author-img">
                <div class="author-name">
                  <h4>{{$comment->name}}</h4>
                  <p class="author-time">{{date('F n, Y - g:iA'), strtotime($comment->created_at)}}</p>
                </div> 
              </div>
              <div class="comment-content">
                {{$comment->comment}}
              </div>
          </div>
        @endforeach

        <hr>
    </div>
</div>
<div class="row">
  <div id="comment-form" class="col-md-4 col-md-offset-2" style="left:0">
    {{Form::open(['route' => ['admin.comment.store', $blog->id], 'method' => 'POST']) }}
    <div class="row">
      <div class=".col-md-6">
        {{Form::label('name', "Name: ") }}
        {{Form::text('name', null, ['class'=>'form-control'])}}

      </div>  
      <div class=".col-md-6">
        {{Form::label('email', "Email: ") }}
        {{Form::text('email', null, ['class'=>'form-control'])}}

      </div>  
      <div class=".col-md-12">
        {{Form::label('comment', "comment: ") }}
        {{Form::textarea('comment', null, ['class'=>'form-control', 'rows'=>'5'])}}
      
      {{Form::submit('Add Comment', ['class'=> 'btn btn-success btn-block'])}}
      </div>  
    </div>
    {{Form::close() }}
  </div>
</div>

<!--<div class="col-sm-4">{!!$blog->title!!}</div> -->
<a href="{{route('admin.blog.edit', ['id' => $blog->id])}}">Edit</a></td>
<a href="{{route('admin.blog.delete', ['id' => $blog->id])}}">Delete</a></td>


<a href="{{route('admin.blog.insert')}}">Insert</a>
</div>



@endsection

