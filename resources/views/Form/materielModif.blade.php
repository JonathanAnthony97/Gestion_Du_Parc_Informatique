@extends('Form.baseModif')
@section('contener')
	<fieldset class="fborder">
		<legend class="fborder"><i>Description Generale</i></legend>
		<div class="form-group" style="border-top:0px;margin-top: 10px;">
			<div class="row">

				<div class="col-md-3">
					<label for="fa" class="control-label">Numero Serie :</label>
					<input id="fa" type="text" name="numSerie" value="{{ $md[0]->num_serie }}" class="form-control">
					<label class="help-block fa"></label>
				</div>

				<div class="col-md-3">
					<label for="fb" class="control-label">Marque :</label>
					<input id="fb" type="text" name="marque" value="{{ $md[0]->marque }}" class="form-control">
					<label class="help-block fb"></label>
				</div>

				<div class="col-md-3">
					<label for="fc" class="control-label">Model :</label>
					<input id="fc" type="text" name="model" value="{{ $md[0]->model }}" class="form-control">
					<label class="help-block fc"></label>
				</div>

				<div class="col-md-3">
					<label for="ab" class="control-label">Type :</label>
					<input style="background-color: #f9f9f9;color: #555555;" name="typ" readonly="readonly" id="ab" type="text" class="form-control" value="{{ $type }}">
					<label class="help-block ab"></label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">

				

				<div class="col-md-3">
					<label for="df" class="control-label">Fournisseur :&nbsp;&nbsp;&nbsp;<a id="modal1" data-toggle="modal" href="#fournisseurModal"><i class="icon-plus-sign bs-tooltip" data-placement="top" data-original-title="Ajouter"></i></a></label>
					<select name="fournisseur" id="df" class="select2 full-width-fix">
						<option value="{{ $md[0]->id_tier }}">{{ $md[0]->nom }}</option>
						@foreach($tiers as $t)
							<option value="{{ $t->id_tier }}">{{ $t->nom }}</option>
						@endforeach
					</select>
					<label style="padding-top: 0px;" class="help-block df"></label>
				</div>

				<div class="col-md-3">
					<label for="fe" class="control-label">Date Acquisition :</label>
					<input id="fe" type="text" placeholder="dd-mm-yyyy hh:ii" name="dateAcquisition" value="{{ date('d-m-Y  H:i',strtotime($md[0]->date_acqui)) }}" class="form-control datepicker">
					<label class="help-block fe"></label>
				</div>

				<div class="col-md-3">
					<label for="ff" class="control-label">Valeur Acquisition (Ar) :</label>
					<input id="ff" type="text" name="valeurAcquisition" value="{{ $md[0]->vlr_acqui }}" class="form-control">
					<label class="help-block ff"></label>
				</div>

				<div class="col-md-3">
					<label for="fg" class="control-label">Garantie (Ans) :</label>
					<input id="fg" type="text" name="garantie" value="{{ $md[0]->garantie }}" class="form-control">
					<label class="help-block fg"></label>
				</div>

			</div>
		</div>
		<div class="form-group">
			<div class="row">

				<div class="col-md-3">
					<label for="fj" class="control-label">Durée Vie (Ans) :</label>
					<input id="fj" type="text" name="duréeVie" value="{{ $md[0]->dure_vie }}" class="form-control">
					<label class="help-block fj"></label>
				</div>

				<div class="col-md-3">
					<label for="fl" class="control-label">Maintenable (mois) :</label>
					<input id="fl" type="text" placeholder="Nombre de mois" name="maintenable" value="{{ $md[0]->maintenable }}" class="form-control">
					<label class="help-block fl"></label>
				</div>


				@if($initial == "Electrique")
				<div class="col-md-3">
					<label for="l3" class="control-label">Puissance (Kva) :</label>
					<input id="l3" type="text" name="puissance" value="{{ $md[0]->puiss }}" class="form-control">
					<label class="help-block l3"></label>
				</div>
				<div class="col-md-3">
					<label for="fint" class="control-label">Intensité (Amps):</label>
					<input id="fint" type="text" name="intensite" value="{{ $md[0]->intesite }}" class="form-control">
					<label class="help-block fint"></label>
				</div>
				@endif
				@if($initial == "Reseau")
				<div class="col-md-3">
					<label for="feth" class="control-label">Nombre Ports Ethernet :</label>
					<input id="feth" type="text" name="ethernetPort" value="{{ $md[0]->ethernet }}" class="form-control">
					<label class="help-block feth"></label>
				</div>
				<div class="col-md-3">
					<label for="fcons" class="control-label">Nombre Ports Console :</label>
					<input id="fcons"  type="text" name="consolePort" value="{{ $md[0]->csl_port }}" class="form-control">
					<label class="help-block fcons"></label>
				</div>
				@endif
			</div>
		</div>

	</fieldset>

	@yield('specs')
@endsection