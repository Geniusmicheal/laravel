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
        <li class="breadcrumb-item"><a href="/dashboard">{{ $record->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">News Categorys</li>
    </ol>
    @if ($message = Session::get('delete'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            {{ $message }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <i class="fa fa-pencil-square-o" ></i> Create Category
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    {{$message}}
                </div>
            @endif
            <form  method="post" class="needs-validation {{ (Session::get('error') != NULL  || Session::get('errors') != NULL ?'was-validated':'') }}" action="{{ route('staffcategory') }}">
                {{ csrf_field() }} 
                <div class="form-group">
                    <label >Add Category</label>
                    <input type="text" class="form-control"  placeholder="Add Category" minlength="3" required  name="category">
                    @if($errors->get('category')!= NULL)
                        <div class="invalid-feedback">{{ $errors->get('category')[0] }}</div>
                    @endif
                </div> 
                <input type="submit" class="btn btn-primary pull-right" value="Add Category">
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <input type="text" class="form-control form-control-sm pull-right" placeholder="Sort by Category">
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Categorys</th>
                        <th>Time Inserted</th>
                        <th>Date Inserted</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x=1; foreach($category as $categorys): ?>
                        <tr>
                            <td><?=$x; $x++;?></td>
                            <td>{{ $categorys->category }}</td>
                            <td>{{ date_format($categorys->created_at,"h:i:sa") }}</td>
                            <td>{{ date_format($categorys->created_at,"l jS \of F Y") }}</td>
                            <td>
                                <input type="button" class="btn delete" value="Delete" onclick="deleteRecord(' {{ route('staffdelete' ,[ 'id' => $categorys->category_id.'~category~'.$categorys->category ] )  }} ')">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <div class="card-footer">{{ $category->render() }}</div>
    </div>
@endsection
@section('script')
//<script>
    const submitButton = document.querySelector("input[type='submit']");
    let forms = document.getElementsByTagName('form');    
    submitButton.addEventListener("click", function(){
        if(forms[0][1].validity.valid==false)
        forms[0].classList.add('was-validated');
    });

    let input = document.querySelector(".form-control-sm");
    input.addEventListener("keyup", function()
    {
        var filter, table, tr, td, i, txtValue;
        filter = input.value.toUpperCase();

        table = document.querySelector("tbody");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) 
        {
            td = tr[i].getElementsByTagName("td")[1];
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1)tr[i].style.display = "";
            else tr[i].style.display = "none";
        }
    });

    function deleteRecord(link){
        if (confirm("Press Ok to Delete or Cancel") == true) location.replace(link);
    }
//</script>
@endsection