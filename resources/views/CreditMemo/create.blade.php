@extends('layouts.app')

@section('content')
<div class="alert alert-dismissible" role="alert">
	<button type="button" title="Close" class="close" aria-label="Close"><span aria-hidden="true"><a href="{{url('/home')}}">&times;</a>		</span></button>
</div>
    <div class="panel panel-primary">

        <div class="panel-heading clearfix">
            
            <div class="pull-left">
                <h4 class="mt-5 mb-5">Create Credit Note</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('CreditMemo.TranMenu.index') }}" class="btn btn-primary" title="Show All Credit Note">
                    <span class="fa fa-th-list" aria-hidden="true"></span>
                </a>

            </div>

        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::open([
                'route' => 'CreditMemo.TranMenu.store',
                'class'=>'form-horizontal',
                'name' => 'create_CreditMemo_form',
                'id' => 'create_CreditMemo_form',
                
                ])
            !!}
			
            @include ('CreditMemo.form', ['TranMenu' => null,])
			
            <div class="form-group" align="center">
              
                    {!! Form::submit('Add', ['id' => 'btnSaveID' , 'class' => 'btn btn-primary']) !!}
             
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('script')

<script src="{{asset('js/modals.js')}}"></script>

<script type="text/javascript">



$("#CRN_PAYMODE").change(function(){
	$('#CRN_CHQNO').val('');
	$('#CRN_CHQNO').attr('readonly','readonly');
	$('#CRN_CHQNO').removeAttr('required','required');
	if($('#CRN_PAYMODE').val()==='3') //Cheque
	{
		$('#CRN_CHQNO').removeAttr('readonly','readonly');
		$('#CRN_CHQNO').attr('required','required');
	}
});
	
</script>
@endsection
