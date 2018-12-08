@extends('layouts.app')

@section('title')
  mainContentPage
@endsection

@section('nav')
@endsection

@section('section')
  @include('componet.content_view.content')
@endsection

@section('footer')

@endsection

@if($search_check)
  @section('my_page')
    @include('componet.search_check')
  @endsection
@else
@endif
