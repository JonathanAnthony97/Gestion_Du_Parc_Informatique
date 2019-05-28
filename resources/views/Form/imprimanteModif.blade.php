@extends('Form.materielModif')
@section('specs')
<fieldset class="fborder">
<legend class="fborder_storage"><i>Description Imprimante</i></legend>
<div class="form-group" style="border-top:0px;margin-top: 10px;">
	<div class="row">
			<div class="col-md-3">
				<label for="imprtype" class="control-label">Type :</label>
				<input id="imprtype" type="text" placeholder="laser , linkjet etc ..." name="typeImpr" value="{{ $md[0]->type_impr }}" class="form-control">
				<label class="help-block imprtype"></label>
			</div>
			<div class="col-md-3">
				<label style="margin-bottom: 8px;" class="control-label">En Couleur : </label><br>
					@if($md[0]->couleur == "true")
						<label class="radio-inline" style="margin-right: 30px;">
						<input type="radio" class="uniform" name="color" value="true" checked>
								Oui
						</label>
						<label class="radio-inline">
						<input type="radio" class="uniform" name="color" value="false" >
								Non
						</label>	
					@else
						<label class="radio-inline" style="margin-right: 30px;">
						<input type="radio" class="uniform" name="color" value="true" >
								Oui
						</label>
						<label class="radio-inline">
						<input type="radio" class="uniform" name="color" value="false" checked>
								Non
						</label>	
					@endif
			</div>
			<div class="col-md-3">
				<label style="margin-bottom: 8px;" class="control-label">Fonction Scan : </label><br>
					@if($md[0]->fct_scan == "true")
						<label class="radio-inline" style="margin-right: 30px;">
						<input type="radio" class="uniform" name="fscan" value="true" checked>
								Oui
						</label>
						<label class="radio-inline">
						<input type="radio" class="uniform" name="fscan" value="false" >
								Non
						</label>
					@else
						<label class="radio-inline" style="margin-right: 30px;">
						<input type="radio" class="uniform" name="fscan" value="true">
								Oui
						</label>
						<label class="radio-inline">
						<input type="radio" class="uniform" name="fscan" value="false" checked>
								Non
						</label>
					
					@endif
			</div>
			<div class="col-md-3">
				<label style="margin-bottom: 8px;" class="control-label">Fonction Fax : </label><br>
					@if($md[0]->fct_fax == "true")
						<label class="radio-inline" style="margin-right: 30px;">
						<input type="radio" class="uniform" name="fax" value="true" checked>
								Oui
						</label>
						<label class="radio-inline">
						<input type="radio" class="uniform" name="fax" value="false" >
								Non
						</label>
					@else
						<label class="radio-inline" style="margin-right: 30px;">
						<input type="radio" class="uniform" name="fax" value="true">
								Oui
						</label>
						<label class="radio-inline">
						<input type="radio" class="uniform" name="fax" value="false" checked>
								Non
						</label>
					@endif
			</div>
			
	</div>
</div>

<div class="form-group" >
	<div class="row">
			<div class="col-md-3">
				<label style="margin-bottom: 8px;" class="control-label">Fonction Copie : </label><br>
					@if($md[0]->fct_copy == "true")
							<label class="radio-inline" style="margin-right: 30px;">
							<input type="radio" class="uniform" name="fcopie" value="true" checked>
								Oui
							</label>
							<label class="radio-inline">
							<input type="radio" class="uniform" name="fcopie" value="false" >
								Non
							</label>
					@else
							<label class="radio-inline" style="margin-right: 30px;">
							<input type="radio" class="uniform" name="fcopie" value="true">
								Oui
							</label>
							<label class="radio-inline">
							<input type="radio" class="uniform" name="fcopie" value="false" checked>
								Non
							</label>
					@endif
			</div>
			<div class="col-md-3">
				<label style="margin-bottom: 8px;" class="control-label">Carte Reseau : </label><br>
					@if($md[0]->crt_reso == "true")
							<label class="radio-inline" style="margin-right: 30px;">
							<input type="radio" class="uniform" name="card" value="true" checked>
								Oui
							</label>
							<label class="radio-inline">
							<input type="radio" class="uniform" name="card" value="false" >
								Non
							</label>
					@else
							<label class="radio-inline" style="margin-right: 30px;">
							<input type="radio" class="uniform" name="card" value="true">
								Oui
							</label>
							<label class="radio-inline">
							<input type="radio" class="uniform" name="card" value="false" checked>
								Non
							</label>
					@endif
			</div>
	</div>
</div>
</fieldset>
@endsection