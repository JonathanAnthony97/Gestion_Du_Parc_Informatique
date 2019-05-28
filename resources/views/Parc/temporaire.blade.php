<div class="modal fade" id="subMenu" style="overflow-y: scroll;">
			<div class="modal-dialog" style="width: 90.2%;margin-top: 0px;">
				<div class="modal-content" style="background-color: #f9f9f9;">
					<div class="modal-header" style="background-color: #ddd !important;padding-top: 7px;padding-left: 8px;padding-bottom: 6px;border-bottom:1px solid #c8c8c8;border-top:1px solid #c8c8c8;">
							<div class="row">
								<div class="col-md-3" style="padding-right: 0px;">
									<input type="hidden" name="temp_serie">
									<input type="hidden" name="temp_id">
									<div class="input-group">
										<span class="input-group-addon">&nbsp;&nbsp;<i class="icon-hdd"> </i><b>&nbsp;</b></span>
										<input class="form-control titl" style="background-color: #f9f9f9;" readonly>
									</div>
								</div>
								<div class="col-md-4" style="padding-left: 8px;">
									<div class="input-group" style="margin-left: 0px;">
										<input class="form-control rech" id="gl_search" placeholder="Search..."><span class="input-group-addon"><i class="icon-search"> </i></span>
									</div>	
								</div>
								<div class="col-md-5">
									<span class="btn-group" style="margin-top: 0px;margin-left: -22px;">
										<button style="padding: 4.5px 10px;" class="btn btn-sm" id="refr" type="button"><i class="icon-refresh"></i> Rafraichir</button>
										<button style="padding: 4.5px 9px;" class="btn btn-sm" id="g1" type="button"><i class="icon-cogs"></i> Intervention</button>
										<button style="padding: 4.5px 26px;" class="btn btn-sm" id="g2" type="button"><i class="icon-ban-circle"></i> Panne</button>
										<button style="padding: 4.5px 27px;" class="btn btn-sm" id="g3" type="button"><i class="icon-share"></i>Cession</button>
									</span>
																
						
									<button style="padding: 4.5px 10px;" class="btn btn-sm pull-right" class="close" data-dismiss="modal" aria-hidden="true">Fermer</button>
												
								</div>
							</div>
					</div>
					<div class="row">
						<div class="col-md-3" style="padding-top: 8px;padding-right: 0px;"><!-- heigth : 710px; -->
							<div class="panel-group" style="margin-left: 8px;margin-bottom: 8px;" id="accordion">
									<div class="panel panel-default" style="margin-bottom: 0px;">
										<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
											<h3 class="panel-title">
												<i id="firstCaret" style="float: right;" class="icon-caret-down"></i>
											Action
											</h3>
										</div>
										<div id="collapseOne" class="panel-collapse in ">
											<div class="panel-body" style="padding: 8px;">
												 <!-- Tabs-->
												<div class="tabbable tabbable-custom customized" style="margin-right: 0px;margin-bottom: 0px;margin-top: -4px;">
													<ul class="nav nav-tabs hehehe">
														<li class="active"><a href="#tabe_f2" data-toggle="tab"><b>Maintenance</b></a></li>
														<li><a href="#tabe_f3" data-toggle="tab"><b>Reparation</b></a></li>
														<li ><a href="#tabe_f1" data-toggle="tab"><b>Affectation</b></a></li>
													</ul>
													<!-- tab affecation -->
													<input type="hidden" name="tr_temp">
													<div class="tab-content" style="overflow:hidden;background:#f9f9f9;">
														<div class="tab-pane" id="tabe_f1">
															<form class="form-vertical" id="Faire_Affectation" method="post" action="{{ route('affectation') }}">
																<div class="row" style="padding-left:16px;margin-right:-25px;margin-bottom: 8px;">
																	{{ csrf_field() }}
																	<input type="hidden" name="id_mat">
																	<input type="hidden" name="id_aff">
																	
																	<div class="col-md-11">
																		<label id="lb" for="deprte" class="control-label pull-left">Departement
																		</label>
																		<br>
																		<select id="deprte" name="departement" class="select2 col-md-12">
																			<option value="0">Choix departement</option>
																		</select>
																		<label id="lb_er" class="help-block deprte"></label>
																	</div>
																</div>
																<div class="row" style="margin-right:-25px;padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-11">
																		<label id="lb" for="daf" class="control-label pull-left">Date Affectation
																		</label>
																		<br>
																		<div class="input-group">

																			<input id="daf" name="dateAffectation" class="form-control daty_af" placeholder="dd-mm-yyyy hh:mm"><span class="input-group-addon"><i class="icon-calendar"> </i></span>
																		</div>
																		<label id="lb_er" class="help-block daf"></label>
																	</div>
																</div>
																<div class="row" style="margin-right:-25px;padding-left:16px;">
																	<div class="col-md-11">
																		<label id="lb" for="usr" class="control-label pull-left">Utilisateur
																		</label>
																		<br>
																		<select id="usr" name="utilisateur" class="select2 col-md-12">
																			<option value="0">Selectionner</option>
																		</select>
																		<label id="lb_er" class="help-block usr"></label>
																	</div>
																</div>
																
																<button id="reset3" style="margin-left: 16px;margin-top: 13px;margin-bottom: 10px;" class="btn btn-sm  pull-left" type="reset"><i class="icon-refresh"></i> Reset</button>
																<button style="margin-right: 18px;margin-top: 13px;margin-bottom: 10px;" class="btn btn-sm  pull-right" type="submit"><i class="icon-check"></i> Sauver</button>
															</form>
														</div>

															<!-- tab maintenance -->
														<div class="tab-pane active" id="tabe_f2">
															<form id="addMaintenance" method="post" action="{{ route('maintenance') }}" class="form-vertical">
																{{ csrf_field() }}
																<input type="hidden" name="id_mat">
																<input type="hidden" name="id_inter">
																<div class="row" style="margin-right:-25px;padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-11">
																		<label id="lb" for="traitant" class="control-label pull-left">Prestataire
																		</label>
																		<br>
																		<select id="traitant" name="prestataire" class="select2 col-md-12">
																			<option value="0">Selectionner</option>
																		</select>
																		<label id="lb_er" class="help-block traitant"></label>
																	</div>
																</div>
																
																<div class="row" style="margin-right:-25px;padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-11">
																		<label id="lb" for="dmain" class="control-label pull-left">Date Maintenance
																		</label>
																		<br>
																		<div class="input-group">
																			<input id="dmain" name="dateMaintenance" class="form-control daty_main" placeholder="dd-mm-yyyy"><span class="input-group-addon"><i class="icon-calendar"> </i></span>
																		</div>
																		<label id="lb_er" class="help-block dmain"></label>
																	</div>
																</div>
																<div class="row" style="margin-right:-25px;padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-11">
																		<label id="lb" for="obs" class="control-label pull-left">Observation
																		</label>
																		<br>
																		<textarea id="obs" name="observation" style="overflow-y: hidden;" class="form-control">
																		</textarea>
																		<label id="lb_er" class="help-block obs"></label>
																	</div>
																</div>
																<div class="row" style="margin-right:-25px;padding-left:16px;">
																	<div class="col-md-11">
																		<label id="lb" for="cout" class="control-label pull-left">Coût (Ar)
																		</label>
																		<br>
																		<input id="cout" name="cout" class="form-control" placeholder="">
																		<label id="lb_er" class="help-block cout"></label>
																	</div>
																</div>
																<button id="reset1" style="margin-left: 16px;margin-top: 13px;margin-bottom: 10px;" class="btn btn-sm  pull-left" type="reset"><i class="icon-refresh"></i> Reset</button>
																<button style="margin-right: 18px;margin-top: 13px;margin-bottom: 10px;" class="btn btn-sm  pull-right" type="submit"><i class="icon-check"></i> Sauver</button>
															</form>
														</div>

															<!-- tab reparation -->
														<div class="tab-pane" id="tabe_f3">
															<form id="addReparation" class="form-vertical" method="post" action="{{ route('reparation') }}">
																{{ csrf_field() }}
																<input type="hidden" name="id_mat">
																<input type="hidden" name="id_inter2">
																
																<div class="row" style="margin-right:-25px;padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-11">
																		<label id="lb" for="prest_rep" class="control-label pull-left">Prestataire
																		</label>
																		<br>
																		<select id="prest_rep" name="prestataire" class="select2 col-md-12">
																			<option value="0">Selectionner</option>
																		</select>
																		<label id="lb_er" class="help-block prest_rep"></label>
																	</div>
																</div>
																
																<div class="row" style="margin-right:-25px;padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-11">
																		<label id="lb" for="d_rep" class="control-label pull-left">Date Reparation
																		</label>
																		<br>
																		<div class="input-group">
																			<input name="dateReparation" id="d_rep" class="form-control date_rep" placeholder="dd-mm-yyyy"><span class="input-group-addon"><i class="icon-calendar"> </i></span>
																		</div>
																		<label id="lb_er" class="help-block d_rep"></label>
																	</div>
																</div>
																<div class="row" style="margin-right:-25px;padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-11">
																		<label id="lb" for="pane_rep" class="control-label pull-left">Panne associée
																		</label>
																		<br>
																		<select id="pane_rep" name="pane" class="select2 col-md-12">
																			<option value="0">Selectionner</option>
																		</select>
																		<label id="lb_er" class="help-block pane_rep"></label>
																	</div>
																</div>
																<div class="row" style="margin-right:-25px;padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-11">
																		<label id="lb" for="obs_rep" class="control-label pull-left">Observation
																		</label>
																		<br>
																		<textarea name="observation" id="obs_rep" style="overflow-y: hidden;" rows="1" class="form-control">
																		</textarea>
																		<label id="lb_er" class="help-block obs_rep"></label>
																	</div>
																</div>
																<div class="row" style="margin-right:-25px;padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-11">
																		<label id="lb" for="piece" class="control-label pull-left">Pièce
																		</label>
																		<br>
																		<textarea id="piece" name="piece" style="overflow-y: hidden;" rows="1" class="form-control">
																		</textarea>
																		<label id="lb_er" class="help-block piece"></label>
																	</div>
																</div>
																<div class="row" style="margin-right:-25px;padding-left:16px;">
																	<div class="col-md-11">
																		<label id="lb" for="cout_rp" class="control-label pull-left">Coût (Ar)
																		</label>
																		<br>
																		<input id="cout_rp" name="cout" class="form-control" placeholder="">
																		<label id="lb_er" class="help-block cout_rp"></label>
																	</div>
																</div>
																<button id="reset2" style="margin-left: 16px;margin-top: 13px;margin-bottom: 10px;" class="btn btn-sm  pull-left" type="reset"><i class="icon-refresh"></i> Reset</button>
																<button style="margin-right: 18px;margin-top: 13px;margin-bottom: 10px;" class="btn btn-sm  pull-right" type="submit"><i class="icon-check"></i> Sauver</button>
															</form>
														</div>
													</div>
												</div>
										<!--END TABS-->
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
											<h3 class="panel-title">
											<i style="float: right;" class="icon-caret-down"></i>
											Panne
											</h3>
										</div>
										<div id="collapseTwo" class="panel-collapse collapse">
											<div class="panel-body">
												<form id="addPanne" action="{{ route('addPanne') }}" class="form-vertical">
														{{ csrf_field() }}
																<input type="hidden" name="id_mat">
																<input type="hidden" name="idPan">
																<input type="hidden" name="numPan">
																<div class="row" style="padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-11">
																		<label id="lb" for="dat_pan" class="control-label pull-left">Date Panne
																		</label>
																		<br>
																		<div class="input-group">
																			<input id="dat_pan" name="datePane" class="form-control dat_pan" placeholder="dd-mm-yyyy hh:mm"><span class="input-group-addon"><i class="icon-calendar"> </i></span>
																		</div>
																		<label class="help-block dat_pan"></label>
																	</div>
																</div>
																<div class="row" style="padding-left:16px;">
																	<div class="col-md-11">
																		<label id="lb" for="desc_pan" class="control-label pull-left">Description 
																		</label>
																		<br>
																		<textarea id="desc_pan" name="description" style="overflow-y: hidden;" class="form-control">
																		</textarea>
																		<label class="help-block desc_pan"></label>
																	</div>
																</div>
																<button id="resetPan" style="margin-left: 16px;margin-top: 13px;margin-bottom: 10px;" class="btn btn-sm  pull-left" type="reset"><i class="icon-refresh"></i> Reset</button>
																<button style="margin-right: 8.5%;margin-top: 13px;margin-bottom: 10px;" class="btn btn-sm  pull-right" type="submit"><i class="icon-check"></i> Sauver</button>
															</form>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapseFor">
											<h3 class="panel-title">
											<i style="float: right;" class="icon-caret-down"></i>
											Cession
											</h3>
										</div>
										<div id="collapseFor" class="panel-collapse collapse">
											<div class="panel-body">
												 <form id="addReform" action="{{ route('addReform') }}" method="post" class="form-vertical">
												 	{{ csrf_field() }}
												 		<input type="hidden" name="id_mat">
												 		<input type="hidden" name="type_mat">
																<div class="row" style="padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-11">
																		<label id="lb" for="obces" class="control-label pull-left">Objet de la reforme
																		</label>
																		<br>
																		<select id="obces" name="objetReforme" class="select2 col-md-12">
																			<option value="0">Vente</option>
																			<option value="1">Don</option>
																			<option value="2">Destruction</option>
																		</select>
																		<label id="lb_er" class="help-block obces"></label>
																	</div>
																</div>
																
																<div class="row" style="padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-11">
																		<label id="lb" for="date_cess" class="control-label pull-left">Date
																		</label>
																		<br>
																		<div class="input-group">
																			<input id="date_cess" class="form-control daty_reform" name="dateReforme" placeholder="dd-mm-yyyy"><span class="input-group-addon"><i class="icon-calendar"> </i></span>
																		</div>
																		<label id="lb_er" class="help-block date_cess"></label>
																	</div>
																</div>
																<div class="row chdinamic" style="padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-11">
																		<label id="lb" for="nom" class="control-label pull-left">Acheteur 
																		</label>
																		<br>
																		<input id="nom" name="nom" class="form-control" placeholder="nom acheteur">
																		<label id="lb_er" class="help-block nom"></label>
																	</div>
																</div>
																
																<div class="row chdinamic2" style="padding-left:16px;">
																	<div class="col-md-11">
																		<label id="lb" for="cout_rf" class="control-label pull-left">Coût (Ar)
																		</label>
																		<br>
																		<input id="cout_rf" name="valeur" class="form-control" placeholder="valeur transaction">
																		<label id="lb_er" class="help-block cout_rf"></label>
																	</div>
																</div>

																<button id="resetRef" style="margin-left: 16px;margin-top: 13px;margin-bottom: 10px;" class="btn btn-sm  pull-left" type="reset"><i class="icon-refresh"></i> Reset</button>
																<button style="margin-right: 8.5%;margin-top: 13px;margin-bottom: 10px;" class="btn btn-sm  pull-right" type="submit"><i class="icon-check"></i> Sauver</button>
															</form>
											</div>
										</div>
									</div>
								</div>
						</div>
						<div class="col-md-9" style="margin-top: 6px;padding-left: 8px;">
							<!-- Tabs-->
										<div class="tabbable tabbable-custom customized" style="margin-right: 8px;margin-bottom: 8px;">
											<ul class="nav nav-tabs hehe">
												<li id="tab_l1" class="active"><a href="#tabe_1" data-toggle="tab"><b>Tracabilites</b></a></li>
												<li id="tab_l2"><a href="#tabe_2" data-toggle="tab"><b>Maintenances</b></a></li>
												<li id="tab_l3"><a href="#tabe_3" data-toggle="tab"><b>Reparations</b></a></li>
												<li id="tab_l4"><a href="#tabe_4" data-toggle="tab"><b>Pannes</b></a></li>
											</ul>
											<div class="tab-content" style="overflow:hidden;">
												<div class="tab-pane active" id="tabe_1">
													<div class="dataTables_wrapper form-inline" role="grid">
														<div class="dataTables_header clearfix">
															<div class="row">
															<div class="col-md-3">
																<div class="dataTables_length"><label><select id="const8" size="1" aria-controls="DataTables_Table_3" class="select2-offscreen" tabindex="-1"><option id="init" value="9">9</option><option value="14">14</option><option value="22">22</option><option value="50">All</option></select> par page</label></div>
															</div>
															<div class="col-md-9">
																<div class="DTTT btn-group pull-right">
																	<a href="{{ URL::to('downloadExcel/xlsx') }}" class="btn DTTT_button_xls"><span>Excel</span></a>
																	<a href="{{ route('pdfview',['download'=>'pdf']) }}" class="btn DTTT_button_pdf"><span>PDF</span></a>
																</div>
															</div>

														</div>
														<div id="ajax_mtrace" style="padding-top: 0px;">
															<!-- table traca -->
														</div>
													</div>
													</div>
												</div>
												<div class="tab-pane" id="tabe_2">
													<div class="dataTables_wrapper form-inline" role="grid">
														<div class="dataTables_header clearfix">
															<div class="row">
															<div class="col-md-12">
																<div class="dataTables_length"><label><select id="const9" size="1" aria-controls="DataTables_Table_3" class="select2-offscreen" tabindex="-1"><option id="init" value="9">9</option><option value="14">14</option><option value="22">22</option><option value="50">All</option></select> par page</label></div>

																<div class="DTTT btn-group pull-right">
																	<a href="{{ URL::to('downloadExcel/xlsx') }}" class="btn DTTT_button_xls"><span>Excel</span></a>
																	<a href="{{ route('pdfview',['download'=>'pdf']) }}" class="btn DTTT_button_pdf"><span>PDF</span></a>
																</div>
															</div>

														</div>
														<div id="ajax_maint" style="padding-top: 0px;">
															<!-- table maintenance -->
														</div>
													</div>
														
													</div>
												</div>
												<div class="tab-pane" id="tabe_3">
													<div class="dataTables_wrapper form-inline" role="grid">
														<div class="dataTables_header clearfix">
															<div class="row">
															<div class="col-md-12">
																<div class="dataTables_length"><label><select id="const10" size="1" aria-controls="DataTables_Table_3" class="select2-offscreen" tabindex="-1"><option id="init" value="9">9</option><option value="14">14</option><option value="22">22</option><option value="50">All</option></select> par page</label></div>

																<div class="DTTT btn-group pull-right">
																	<a href="{{ URL::to('downloadExcel/xlsx') }}" class="btn DTTT_button_xls"><span>Excel</span></a>
																	<a href="{{ route('pdfview',['download'=>'pdf']) }}" class="btn DTTT_button_pdf"><span>PDF</span></a>
																</div>
															</div>

														</div>
														<div id="ajax_rep" style="padding-top: 0px;">
															<!-- table reparation -->
														</div>
													</div>
														
													</div>
												</div>
												<div class="tab-pane" id="tabe_4">
													<div class="dataTables_wrapper form-inline" role="grid">
														<div class="dataTables_header clearfix">
															<div class="row">
															<div class="col-md-12">
																<div class="dataTables_length"><label><select id="const11" size="1" aria-controls="DataTables_Table_3" class="select2-offscreen" tabindex="-1"><option id="init" value="9">9</option><option value="14">14</option><option value="22">22</option><option value="50">All</option></select> par page</label></div>

																<div class="DTTT btn-group pull-right">
																	<a href="{{ URL::to('downloadExcel/xlsx') }}" class="btn DTTT_button_xls"><span>Excel</span></a>
																	<a href="{{ route('pdfview',['download'=>'pdf']) }}" class="btn DTTT_button_pdf"><span>PDF</span></a>
																</div>
															</div>

														</div>
														<div id="ajax_pan" style="padding-top: 0px;">
															<!-- table reparation -->
														</div>
													</div>
														
													</div>
												</div>
											</div>
										</div>
										<!--END TABS-->
						</div>
					</div>
					<div style="height: 5px;padding: 0px;background:#ddd" class="modal-footer">
						
					</div>
						
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->