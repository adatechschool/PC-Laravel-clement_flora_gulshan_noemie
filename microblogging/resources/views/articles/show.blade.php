@extends("layouts.app")
@section("content")
  {{$article->user->name}}: 
  {{$article->description}}
  <img src="{{ asset('storage/'.trim($article->img_url, '"')) }}" height="700px" width="700px" alt="">
@endsection