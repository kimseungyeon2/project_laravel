@extends('layouts.app')

@section('title')
  insertPage
@endsection

@section('header')

@endsection

@section('section')
  @include('componet.content_view.content_detail')
  <div id="comments">
    @include('componet.comment_view.comment')
  </div>
@endsection

@section('footer')

@endsection
