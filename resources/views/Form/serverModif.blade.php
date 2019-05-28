@extends('Form.materielModif')
@section('specs')
<fieldset class="fborder">
<legend class="fborder_server"><i>Description Serveur</i></legend>
<div class="form-group" style="border-top:0px;margin-top: 10px;">
	<div class="row">
			<div class="col-md-3">
				<label for="l" class="control-label">Nom (Netbios) :</label>
				<input id="l" type="text" name="netbios" value="@isset($md[0]->netbios){{ $md[0]->netbios }}@endisset" class="form-control">
				<label class="help-block l"></label>
			</div>
			<div class="col-md-3">
				<label for="fip" class="control-label">Adresse Ip :</label>
				<input id="fip" type="text" placeholder="xxx.xxx.xxx.xxx" name="adrIp" value="{{ $md[0]->ipAdr }}" class="form-control">
				<label class="help-block fip"></label>
			</div>
			<div class="col-md-3">
				<label for="srv" class="control-label">Utilisaton (roles) :</label>
				<input id="srv" placeholder="Utilisation" type="text" name="utilisation" value="{{ $md[0]->utilisation }}" class="form-control">
				<label class="help-block srv"></label>
			</div>
			<div class="col-md-3">
				<label for="fproce" class="control-label">Nombre Processeurs :</label>
				<input id="fproce" type="text" name="processeur" value="{{ $md[0]->nbProces }}" class="form-control">
				<label class="help-block fproce"></label>
			</div>
			
	</div>
</div>

<div class="form-group" >
	<div class="row">
		<div class="col-md-3">
				<label for="modcpu" class="control-label">Model (CPU) :</label>
				<input id="modcpu" type="text" placeholder="exemple MGTMM1" name="modelCpu" value="{{ $md[0]->model_cpu }}" class="form-control">
				<label class="help-block modcpu"></label>
			</div>
			<div class="col-md-3">
				<label for="ffreq" class="control-label">CPU Frequences (GHz) :</label>
				<input id="ffreq" type="text" name="freqCpu" value="{{ $md[0]->frequences }}" class="form-control">
				<label class="help-block ffreq"></label>
			</div> 
			<div class="col-md-3">
				<label for="fchip" class="control-label">Nombre Chipset :</label>
				<input id="fchip" type="text" name="chips" value="{{ $md[0]->memoChips }}" class="form-control">
				<label class="help-block fchip"></label>
			</div>
			<div class="col-md-3">
				<label for="typram" class="control-label">Type RAM :</label>
				<input id="typram" placeholder="SDRAM,DDR2,DDR3 etc..." type="text" name="typeRam" value="{{ $md[0]->type_memo }}" class="form-control">
				<label class="help-block typram"></label>
			</div> 
			
	</div>
</div>
<div class="form-group" >
	<div class="row">
			<div class="col-md-3">
				<label for="ftotram" class="control-label">Taille Total (RAM) :</label>
				<input id="ftotram" type="text" name="totalRam" value="{{ $md[0]->total }}" class="form-control">
				<label class="help-block ftotram"></label>
			</div>
			<div class="col-md-3">
				<label for="fndisc" class="control-label">Nombre Disque Dur :</label>
				<input id="fndisc" type="text" name="nbDisque" value="{{ $md[0]->nbDisk }}" class="form-control">
				<label class="help-block fndisc"></label>
			</div>
			<div class="col-md-3">
				<label for="typdisc" class="control-label">Type Disque Dur :</label>
				<input id="typdisc" placeholder="SAS, SCSI, IDE, SATA..." type="text" name="typeDisque" value="{{ $md[0]->type_disk }}" class="form-control">
				<label class="help-block typdisc"></label>
			</div>
			<div class="col-md-3">
				<label for="ftaidisc" class="control-label">Taille Par Disque (GBytes) :</label>
				<input id="ftaidisc" type="text" name="tailleParDisque" value="{{ $md[0]->taille_par_disk }}" class="form-control">
				<label class="help-block ftaidisc"></label>
			</div>
	</div>
</div>
<div class="form-group">
	<div class="row">
			
			<div class="col-md-3">
				<label for="raid" class="control-label">Type RAID :</label>
				<input id="raid" placeholder="RAID1,RAID2 etc" type="text" name="typeRaid" value="{{ $md[0]->type_raid }}" class="form-control">
				<label class="help-block raid"></label>
			</div>
			<div class="col-md-3">
				<label for="typos" class="control-label">Type OS :</label>
				<input id="typos" type="text" name="typeOs" value="{{ $md[0]->type_os }}" class="form-control">
				<label class="help-block typos"></label>
			</div>
			<div class="col-md-3">
				<label for="lang" class="control-label">OS Langage :</label>
				<input id="lang" placeholder="Fr,En etc ..." type="text" name="langOs" value="{{ $md[0]->lang_os }}" class="form-control">
				<label class="help-block lang"></label>
			</div>
			<div class="col-md-3">
				<label for="fpack" class="control-label">Nb Service Pack (OS):</label>
				<input id="fpack" placeholder="pack de service os" type="text" name="pack" value="{{ $md[0]->srv_pack }}" class="form-control">
				<label class="help-block fpack"></label>
			</div>
			
	</div>
</div>
<div class="form-group">
	<div class="row">
			
	
	</div>
</div>
</fieldset>
@endsection