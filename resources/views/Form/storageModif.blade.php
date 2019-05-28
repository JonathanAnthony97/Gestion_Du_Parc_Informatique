@extends('Form.materielModif')
@section('specs')
<fieldset class="fborder">
<legend class="fborder_storage"><i>Description Disque Dur</i></legend>
<div class="form-group" style="border-top:0px;margin-top: 10px;">
	<div class="row">
			<div class="col-md-3">
				<label for="srv" class="control-label">Services (roles) :</label>
				<input id="srv" type="text" placeholder="Utilisation" name="utilisation" value="{{ $md[0]->utilisation }}" class="form-control">
				<label class="help-block srv"></label>
			</div>
			<div class="col-md-3">
				<label for="fndisc" class="control-label">Nb Disque Dur  :</label>
				<input id="fndisc" type="text" name="nbDisque" value="{{ $md[0]->nbDisk }}" class="form-control">
				<label class="help-block fndisc"></label>
			</div>
			<div class="col-md-3">
				<label for="typdisc" class="control-label">Type Disque Dur :</label>
				<input id="typdisc" type="text" name="typeDisque" value="{{ $md[0]->type_disk }}" class="form-control">
				<label class="help-block typdisc"></label>
			</div>
			<div class="col-md-3">
				<label for="ftaidisc" class="control-label">Taille Par Disque (Gbytes) :</label>
				<input id="ftaidisc" type="text" name="tailleParDisque" value="{{ $md[0]->taille_par_disk }}" class="form-control">
				<label class="help-block taidisc"></label>
			</div>
	</div>
</div>
<div class="form-group" >
	<div class="row">
			<div class="col-md-3">
				<label for="raid" class="control-label">Type RAID :</label>
				<input id="raid" placeholder="RAID1,RAID2 etc" type="text" name="typeRaid" value="{{ $md[0]->type_raid }}" class="form-control">
				<label class="help-block raid"></label>
			</div>
	</div>
</div>
</fieldset>
@endsection