@extends('Form.materielModif')
@section('specs')
<fieldset class="fborder">
<legend class="fborder_server"><i>Description Firewall</i></legend>
<div class="form-group" style="border-top:0px;margin-top: 10px;">
	<div class="row">
		<div class="col-md-3">
					<label for="l" class="control-label">Nom (Netbios) :</label>
						<input id="l" type="text" name="netbios" value="@isset($md[0]->netbios){{ $md[0]->netbios }}@endisset" class="form-control">
						<label class="help-block l"></label>
				</div>
			<div class="col-md-3">
				<label for="feth" class="control-label">Nb Ports Ethernet :</label>
				<input id="feth" type="text" name="ethernetPort" value="{{ $md[0]->ethernet }}" class="form-control">
				<label class="help-block feth"></label>
			</div>
			<div class="col-md-3">
				<label for="fcons" class="control-label">Nb Ports Console :</label>
				<input id="fcons" type="text" name="consolePort" value="{{ $md[0]->csl_port }}" class="form-control">
				<label class="help-block cons"></label>
			</div>
	</div>
</div>
</fieldset>
@endsection