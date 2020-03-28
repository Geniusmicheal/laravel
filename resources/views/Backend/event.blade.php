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
            /* background-color: white;
            border-color: #dbdbdb; */
            border-radius: 2px;
            font-size: 0.75rem;
            padding: calc(0.27em - 1px) 0.6em;
            color: white;
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
            <input type="text" class="form-control form-control-sm pull-right" placeholder="Sort by event">
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event</th>
                        <th>Event Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x=1; foreach($event as $events): ?>
                        <tr>
                            <td><?=$x; $x++;?></td>
                            <td>{{ $events->name }}</td>
                            <td>
                                <?php if(stripos($events->event_date,'*')): ?>
                                    <?php $eventdate = explode('*', $events->event_date); ?>
                                    
                                    {{ date_format(date_create($eventdate[0]),"jS M").'-'.date_format(date_create($eventdate[1]),"jS M Y") }}
                                <?php else: ?>
                                    {{ date_format(date_create($events->event_date),"jS M Y") }}
                                <?php endif; ?>
                            </td>
                            <td>
                                <button type="button" class="btn delete btn-danger" title="Delete"  onclick="deleteRecord('{{ route('staffdelete' , [ 'id' => $events->event_id . '~event~'.$events->name]) }} ')"> 
                                    <i class="fa fa-trash-o" style="font-size: medium;"></i>
                                </button>

                                <a href="{{ route('staffEditevent',['id'=>$events->slug.'~edit'])}}" class="btn delete btn-success" title="Edit">
                                    <i class="fa fa-pencil-square-o" style="font-size: medium;"></i>
                                </a>
                                
                                <a href="{{ route('staffviewevent',['id'=>$events->slug.'~view']) }}" class="btn delete btn-primary" title="view">
                                    <i class="fa fa-eye" style="font-size: medium;"></i>
                                </a>

                                <a href="{{ route('staffeventswitch',[ 'id' => $events->slug.'~'.$events->event_id .'~'.$events->name]) }}?type={{ $active == 'active' ? 'deactive': 'active' }}" class="btn delete btn-warning" title="{{ $active == 'active' ? 'Deactivate': 'Activate' }}">
                                    <i class="fa {{ $active == 'active' ? 'fa-calendar-times-o': 'fa-calendar-check-o' }}" style="font-size: medium;"></i>
                                </a>
                            </td>
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
    input.addEventListener("keyup", () => {

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