@extends('layouts.app')

@section('title')
  mainPage
@endsection

@section('header')

@endsection

@section('section')
  @include('componet.my_status_log')
  @include('componet.log_check_update_view')
  @include('componet.log_check_delete_view')
@endsection

@section('footer')

@endsection
