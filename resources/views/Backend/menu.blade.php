@extends('Backend/layout')
@section('style')
    <style>
        .card{
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-top: 3px solid #00c0ef;
            word-wrap:normal;
            margin-bottom: 30px;

        }
        .form-control-sm{width: 220px;}
        .card-footer {padding: .75rem 1.25rem 0px 1.25rem; }
        .delete{
            background-color: white;
            border-color: #dbdbdb;
            border-radius: 2px;
            font-size: 0.75rem;
            padding: calc(0.375em - 1px) 0.75em;
        }
    </style>
@endsection
@section('content')
    <ol class="breadcrumb has-background-white">
        <li class="breadcrumb-item"><a href="/dashboard">{{ $user}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Assigned Menu</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('staffAddMenu') }}"> 
                <i class="fa fa-pencil-square-o" ></i> Create Menu
            </a> 
            <input type="text" class="form-control form-control-sm pull-right" placeholder="Sort by headline">
        </div>
        <div class="card-body table-responsive"></div>
    </div>
@endsection