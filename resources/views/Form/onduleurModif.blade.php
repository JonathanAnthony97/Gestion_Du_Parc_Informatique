@extends('Form.materielModif')
@section('specs')
<fieldset class="fborder">
<legend class="fborder_storage"><i>Description Onduleur</i></legend>
<div class="form-group" style="border-top:0px;margin-top: 10px;">
	<div class="row">
			<div class="col-md-3">
				<label for="fph" class="control-label">Nombre Phase :</label>
				<input id="fph" type="text" name="phase" value="{{ $md[0]->phase }}" class="form-control">
				<label class="help-block fph"></label>
			</div>
			<div class="col-md-3">
				<label for="auto" class="control-label">Autonomie (hh:mm) :</label>
				<input id="auto" type="text" name="autonomie" value="{{ $md[0]->autonomi }}" class="form-control">
				<label class="help-block auto"></label>
			</div>
			<div class="col-md-3">
				<label for="fbat" class="control-label">Nombre Batterie :</label>
				<input id="fbat" type="text" name="bateri" value="{{ $md[0]->nbBat }}" class="form-control">
				<label class="help-block fbat"></label>
			</div>
			
	</div>
</div>

</fieldset>
@endsection