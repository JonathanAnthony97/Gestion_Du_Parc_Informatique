@extends('Form.materielModif')
@section('specs')
<fieldset class="fborder">
<legend class="fborder_server"><i>Description Ecran</i></legend>
<div class="form-group" style="border-top:0px;margin-top: 10px;">
	<div class="row">
			<div class="col-md-3">
				<label for="m" class="control-label">N° Serie Moniteur :</label>
				<input id="m" type="text" name="numSeriMoniteur" value="{{ $md[0]->numSer }}" class="form-control">
				<label class="help-block m"></label>
			</div>
			<div class="col-md-3">
				<label for="n" class="control-label">Marque Moniteur :</label>
				<input id="n"  type="text" name="marqueMoniteur" value="{{ $md[0]->mrk }}" class="form-control">
				<label class="help-block n"></label>
			</div>
			<div class="col-md-3">
				<label for="o" class="control-label">Model Moniteur :</label>
				<input id="o" type="text" name="modelMoniteur" value="{{ $md[0]->modele }}" class="form-control">
				<label class="help-block o"></label>
			</div>
	</div>
</div>

</fieldset>
@endsection