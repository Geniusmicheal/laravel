@extends('backend/layout')
@section('style')
    <style>
        .card{
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-top: 3px solid #00c0ef;
        }
        .form-control-sm{width: 220px;}
    </style>

@endsection
@section('content')
    <ol class="breadcrumb has-background-white">
        <li class="breadcrumb-item"><a href="/dashboard">{{ session('adminLogin')[0]->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Roles & Permission</li>
    </ol>

   
    <div class="card">
        <div class="card-header">
            <a href="createRole">
                <i class="fa fa-pencil-square-o"></i> Create Role
            </a>
            <input type="text" class="form-control form-control-sm pull-right" placeholder="Sort by Roles or Create By">
            
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-striped table-bordered table-sm">
                   
                    <tr>
                        <th>#</th>
                        <th>Roles</th>
                        <th>Time Inserted</th>
                        <th>Date Inserted</th>
                        <th>Inserted By</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>John</td>
                        <td>Doe</td>
                        <td>john@example.com</td>
                    </tr>
                    <tr>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                    </tr>
                    <tr>
                        <td>July</td>
                        <td>Dooley</td>
                        <td>july@example.com</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card-footer">Footer</div>
    </div>

@endsection