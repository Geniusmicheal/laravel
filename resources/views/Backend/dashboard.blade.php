@extends('Backend/layout')
@section('content')
    <ol class="breadcrumb has-background-white">
        <li class="breadcrumb-item"><a href="#">{{ $user }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Overview</li>
    </ol>
@endsection