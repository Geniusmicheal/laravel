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
        <li class="breadcrumb-item active" aria-current="page">News Overveiw</li>
    </ol>
    @if ($message = Session::get('delete'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            {{ $message }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a href="{{ route('staffAddNews') }}"> <i class="fa fa-pencil-square-o" ></i> Add News </a> 
            <input type="text" class="form-control form-control-sm pull-right" placeholder="Sort by headline">
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Headline</th>
                        <th>Source</th>
                        <th>Category</th>
                        <th>Date Inserted</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x=1; foreach($content as $contents): ?>
                        <tr>
                            <td><?=$x; $x++;?></td>
                            <td>{{ $contents->headline }}</td>
                            <td>{{ $contents->source }}</td>
                            <td>{{ $contents->category }}</td>
                            <td>{{ date_format($contents->created_at,"l jS \of F Y") }}</td>
                            <th> 
                                <input type="button" class="btn delete" value="Delete" onclick="deleteRecord('{{ route('staffdelete' , [ 'id' => $contents->news_id . '~news~'.$contents->headline]) }} ')">
                                
                                <a href="{{ route('staffEditNews',['id'=>$contents->slug.'~edit'])}}" class="btn delete">Edit</a>
                                <a href="{{ route('staffViewNews',['id'=>$contents->slug.'~view'])}}" class="btn delete">View</a>
                                <!-- <input type="button"  value=""> -->
                             

                            </th>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
//<script>
    function deleteRecord(link){
        if (confirm("Press Ok to Delete or Cancel") == true) location.replace(link);
    }
    let input = document.querySelector(".form-control");
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

//</script>
@endsection