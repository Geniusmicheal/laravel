@extends('Backend/layout')
@section('style')

    <style>
        .card{
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-top: 3px solid #00c0ef;
            word-wrap:normal;

        }
        .form-control-sm{width: 220px;}
        .card-footer {padding: .75rem 1.25rem 0px 1.25rem; }
    </style>

@endsection
@section('content')
    <ol class="breadcrumb has-background-white">
        <li class="breadcrumb-item"><a href="/dashboard">{{ $record->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
    </ol>
    <div class="card">
        <div class="card-header">
            <input type="text" class="form-control form-control-sm pull-right" placeholder="Sort by Logs">
        </div>
        <div class="card-body table-responsive">

            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>Logs</th>
                        <th>Time</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x=1; foreach($log as $logs): ?>
                        <tr>
                            <td><?=$x; $x++;?></td>
                            <td>{{ $logs->stafflog }}</td>
                            <td>{{ date_format($logs->created_at,"h:i:sa") }}</td>
                            <td>{{ date_format($logs->created_at,"l jS \of F Y") }}</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <div class="card-footer">{{ $log->render() }}</div>
    </div>
@endsection
@section('script')
//<script>
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