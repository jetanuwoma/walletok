@if($transaction->Status->id == 1)
<span class="badge badge-success">{{$transaction->Status->name}}</span>
@elseif($transaction->Status->id == 2)
<button class="btn btn-sm btn-outline-danger">{{$transaction->Status->name}}</button>
@elseif($transaction->Status->id == 3)
<span class="badge badge-info">{{$transaction->Status->name}}</span>
@elseif($transaction->Status->id == 4)
<button class="btn btn-sm btn-outline-primary">{{$transaction->Status->name}}</button>
@endif