@extends('Userend/layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="error">

                @if($errors->any())
                    <div class="alert alert-danger ">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <?=(Session::get('error') != NULL )? '<div class="alert alert-danger">'.Session::get('error').'</div>':'' ?>

            </div>
            
            <form  method="post" class="needs-validation {{ (Session::get('error') != NULL  || Session::get('errors') != NULL ?'was-validated':'') }}" action="{{ route('userupdatepassword') }}">
                {{ csrf_field() }}  
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" class="form-control"  placeholder="Current Password" required name="current">
                    @if($errors->get('current')!= NULL)
                        <div class="invalid-feedback">{{ $errors->get('current')[0] }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control"  placeholder="New Password" required name="new">
                    @if($errors->get('new')!= NULL)
                        <div class="invalid-feedback">{{ $errors->get('new')[0] }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Re-type Password</label>
                    <input type="password" class="form-control"  placeholder="Re-type Password" required name="reType">
                    @if($errors->get('reType')!= NULL)
                        <div class="invalid-feedback">{{ $errors->get('reType')[0] }}</div>
                    @endif
                </div>
                <div class="form-group pull-right">
                    <input type="submit" class="btn btn-primary" value="Change Password">
                </div>
            </form>
        </div>
    </div>
@endsection