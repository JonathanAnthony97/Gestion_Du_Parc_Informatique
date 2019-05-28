<fieldset class="fborder">
<legend class="fborder_server"><i>Description Serveur</i></legend>
<div class="form-group" style="border-top:0px;margin-top: 10px;">
	<div class="row">
			<div class="col-md-3">
				<label for="ip" class="control-label">Adresse Ip :</label>
				<input id="ip" type="text" placeholder="xxx.xxx.xxx.xxx" name="adrIp" class="form-control">
				<label class="help-block ip"></label>
			</div>
			<div class="col-md-3">
				<label for="srv" class="control-label">Utilisation (roles) :</label>
				<input id="srv" placeholder="Utilisation" type="text" name="utilisation" class="form-control">
				<label class="help-block srv"></label>
			</div>
			<div class="col-md-3">
				<label for="proce" class="control-label">Nombre Processeur :</label>
				<input id="proce" type="text" name="processeur" class="form-control">
				<label class="help-block proce"></label>
			</div>
			<div class="col-md-3">
				<label for="modcpu" class="control-label">Model (CPU) :</label>
				<input id="modcpu" type="text" placeholder="exemple MGTMM1" name="modelCpu" class="form-control">
				<label class="help-block modcpu"></label>
			</div>
	</div>
</div>

<div class="form-group" >
	<div class="row">
			<div class="col-md-3">
				<label for="freq" class="control-label">CPU Frequences (GHz) :</label>
				<input id="freq" type="text" name="freqCpu" class="form-control">
				<label class="help-block freq"></label>
			</div> 
			<div class="col-md-3">
				<label for="chip" class="control-label">Nombre Chipset :</label>
				<input id="chip" type="text" name="chips" class="form-control">
				<label class="help-block chip"></label>
			</div>
			<div class="col-md-3">
				<label for="typram" class="control-label">Type RAM :</label>
				<input id="typram" placeholder="SDRAM,DDR2,DDR3 etc..." type="text" name="typeRam" class="form-control">
				<label class="help-block typram"></label>
			</div> 
			<div class="col-md-3">
				<label for="totram" class="control-label">Taille Totale (RAM) :</label>
				<input id="totram" type="text" name="totalRam" class="form-control">
				<label class="help-block totram"></label>
			</div>
	</div>
</div>
<div class="form-group" >
	<div class="row">
			
			<div class="col-md-3">
				<label for="ndisc" class="control-label">Nb Disque Dur :</label>
				<input id="ndisc" type="text" name="nbDisque" class="form-control">
				<label class="help-block ndisc"></label>
			</div>
			<div class="col-md-3">
				<label for="typdisc" class="control-label">Type Disque Dur :</label>
				<input id="typdisc" placeholder="SAS, SCSI, IDE, SATA..." type="text" name="typeDisque" class="form-control">
				<label class="help-block typdisc"></label>
			</div>
			<div class="col-md-3">
				<label for="taidisc" class="control-label">Taille Par Disque (GBytes) :</label>
				<input id="taidisc" type="text" name="tailleParDisque" class="form-control">
				<label class="help-block taidisc"></label>
			</div>
			<div class="col-md-3">
				<label for="raid" class="control-label">Type RAID :</label>
				<input id="raid" placeholder="RAID1,RAID2 etc" type="text" name="typeRaid" class="form-control">
				<label class="help-block raid"></label>
			</div>
	</div>
</div>
<div class="form-group">
	<div class="row">
			
			<div class="col-md-3">
				<label for="typos" class="control-label">Type OS :</label>
				<input id="typos" type="text" name="typeOs" class="form-control">
				<label class="help-block typos"></label>
			</div>
			<div class="col-md-3">
				<label for="lang" class="control-label">OS Langage :</label>
				<input id="lang" placeholder="Fr,En etc ..." type="text" name="langOs" class="form-control">
				<label class="help-block lang"></label>
			</div>
			<div class="col-md-3">
				<label for="pack" class="control-label">Nb Service Pack (OS):</label>
				<input id="pack" placeholder="pack de service os" type="text" name="pack" class="form-control">
				<label class="help-block pack"></label>
			</div>
	</div>
</div>

</fieldset>