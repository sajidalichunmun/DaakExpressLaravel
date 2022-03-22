@extends('layouts.modals')
@section('content')

<div class="panel-body">


<div class="row">
<div class="row">

<div class="col-md-12">

<div class="well">
<strong>Container Number</strong>
{{$container}}
</div>
</div>
</div>
<div class="col-md-12">

<?php

$session = session()->put('amount',0);
?>
<table class="table">

<thead>

<tr>


<th>SN</th>
<th>Charge description</th>

<th>Amount</th>


</tr>
</thead>
<tbody>
<?php $i=1;?>

@foreach($mpsCharges as $charge)
<tr>
<?php

session()->put('amount',session()->get('amount') + $charge->amount);
?>
<td>{{$i++}}</td>
<td>{{$charge->charge->charge_description}}</td>

<td>{{$charge->amount}}</td>



<td></td>

</tr>

@endforeach


</tbody>

<tfoot>

<tr>

<th>TOTAL</th>

<th></th>
<th>{{number_format(session()->get('amount'),3)}}</th>
</tr>
</tfoot>

</table>


</div>

</div>

</div>
@endsection