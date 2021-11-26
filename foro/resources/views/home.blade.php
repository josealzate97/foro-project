@extends('layouts.master-layout')

@section('nav-home')

@endsection

@section('content')
    <section class="row col-lg-12 col-md-12 col-sm-12">
        {{ Session::get('user') }}
    </section>
@endsection
