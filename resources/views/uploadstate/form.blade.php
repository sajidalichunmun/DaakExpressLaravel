<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			<label for="txtMajorNameID">CLIENT MAJOR NAME</label>
			<input type="text" class="form-control" placeholder="Client Major Name"  name="txtMajorNameID" id="txtMajorNameID" readonly="">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="ClientCodeID">CLIENT NAME</label>
			{!! Form::select('ClientCodeID',['' => 'Select Client Name'] + $client,null, ['id' => 'ClientCodeID', 'class' => 'form-control',  'required' => true, 'title' => 'Client']) !!}
			{!! $errors->first('ClientCodeID', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
</div>