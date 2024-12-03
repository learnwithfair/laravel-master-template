@extends('frontend.layout.master')
@section('modal')
    <!-- Custom Spinner Start -->
    @include('modal._spinner')
    <!-- Custom Spinner End -->
@endsection
@section('script')
    <!-- ***** Script Start ***** -->
    @include('frontend.layout._script')
    <!-- ***** Script End  ***** -->
    @include('frontend.ajax._messageJS')
@endsection
