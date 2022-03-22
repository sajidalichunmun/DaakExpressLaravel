@extends('layouts.app')

@section('css')
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/> -->
@endsection

@section('content')
    <div class="panel panel-primary">
        @if(count($result) == 0)
            <div class="panel-body text-center">
                <h4>No Reason Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
			<div class="row">
				<div class="table-responsive" id="employee_table">
					<table class="table table-striped" id="tbExport">
                        @foreach($result as $v)
                            <tr>
                                <td>Pod Date : {{ $v->PodDate }}</td>
                                <td>{{$v->AwbNo}}</td>
                                <td>Pod Date : {{ $v->PodDate }}</td>
                                <td>{{$v->AwbNo}}</td>
                            </tr>
                            <tr>
                                <td colspan=2>CI Code : {{ $v->ClientCode }}</td>
                                <td colspan=2>CI Code : {{ $v->ClientCode }}</td>
                            </tr>
                            <tr>
                                <td colspan=2>CI Name : {{ $v->MajorName }}</td>
                                <td colspan=2>CI Name : {{ $v->MajorName }}</td>
                            </tr>
                            <tr>
                                <td colspan=2>Name : {{ $v->CustomerName }}</td>
                                <td colspan=2>Name : {{ $v->CustomerName }}</td>
                            </tr>
                            <tr>
                                <td colspan=2>Area : {{ $v->Address1 }}&nbsp;{{ $v->Address2 }}&nbsp;{{ $v->SubCity }}&nbsp;{{ $v->Pincode }} </td>
                                <td colspan=2>Area : {{ $v->Address1 }}&nbsp;{{ $v->Address2 }}&nbsp;{{ $v->SubCity }}&nbsp;{{ $v->Pincode }} </td>
                            </tr>
                            <tr> 
                                <td colspan=2>Ref No :</td>
                                <td colspan=2>Ref No :</td>
                            </tr>
                            <tr>
                                <td colspan=2>Receiver Name:___________________</td>
                                <td colspan=2>Receiver Name:___________________</td>
                            </tr>
                            <tr>
                                <td colspan=2>Sign & Phone:____________________</td>
                                <td colspan=2>Sign & Phone:____________________</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endsection