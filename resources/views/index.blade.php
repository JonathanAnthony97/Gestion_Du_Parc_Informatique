@extends('layouts.dashboard')
@section('sidebar')
		<div id="sidebar" class="sidebar-fixed">
			<div class="row" style="height: 58px;overflow-y: hidden;">
				<div class="col-md-11 col-md-offset-1" >
					<div class="widget">
						<div style="border-color: #d9d9d9;height: 39px;padding-top:12px; " class="widget-header">
								<i><h4 style="margin-left: 15px;margin-bottom: 0px;color:#334d63;padding-right: 3px;"> Menu</h4></i>						
							</div>
					</div>
				</div>
			</div>
			<div id="sidebar-content">
				<div class="row">
					<div class="col-md-11 col-md-offset-1" style="margin-top: 0px;">
						<div class="widget">
							<div class="widget-content" style="margin-top: 0px;">
								<div class="list-group">
        						<a id="first" class="list-group-item g_m active" data-toggle="collapse" data-target="#sample1">
    								<img src="{{ asset('assets/image/peri.png') }}"> <b>Materiel</b> <i style="float: right;padding-top: 2px;" class="arrow icon-angle-left"></i>
  								</a>
  									<div class="collapse" style="overflow-y: hidden;" id="sample1">
  										<div class="card card-body menuSide">	
  										</div>
									</div>
								<a href="{{ route('suivi') }}" class="list-group-item">
    								<img src="{{ asset('assets/image/trace2.png') }}">  <b style="margin-left: -3px;">Tracabilité</b> </a>
								<a href="{{ route('util') }}" class="list-group-item"><img src="{{ asset('assets/image/frs.png') }}"></i> <b>Fournisseur</b></a>
								<a href="{{ route('util') }}" class="list-group-item"><img src="{{ asset('assets/image/user.png') }}"> <b style="margin-left: 3px;">Prestataire</b></a>
						        <a href="#" class="list-group-item g_m1" data-toggle="collapse" data-target="#sample2">	<img src="{{ asset('assets/image/cle.png') }}"> <b>Intervention</b> <i style="float: right;padding-top: 2px;" class="arrow icon-angle-left"></i></a>
						       		<div class="collapse" style="overflow-y: hidden;" id="sample2">
  										<div class="card card-body">
    										<a id="sd1" href="{{ route('histo') }}" style="border-bottom: 0px;" class="list-group-item"><span style="padding-left: 22px;"><i id="i" class="icon-refresh"></i>  Reparation</span></a>
						        			<a id="sd1" href="{{ route('histo') }}" style="border-bottom: 0px;border-top:0px;" class="list-group-item"><span style="padding-left: 22px;"><i id="i" class="icon-cogs"></i>  Maintenance</span></a>
  										</div>
									</div>
    							<a id="last" href="{{ route('util') }}" class="list-group-item">
    								<img src="{{ asset('assets/image/use.png') }}"> <b style="margin-left: 1px;">Utilisateur</b> </a>
      						</div>
      						<div class="list-group">
      							<a id="first" href="{{ route('bilan') }}" class="list-group-item"><img src="{{ asset('assets/image/bar.png') }}"> <b>Bilan</b></a>
      							<a  href="{{ route('invent') }}" class="list-group-item"><img src="{{ asset('assets/image/folder.png') }}">  <b>Inventaire</b></a>
      							<a href="#" class="list-group-item g_m2" data-toggle="collapse" data-target="#sample3"><img src="{{ asset('assets/image/histo.png') }}"> <b>Historiques</b> <i style="float: right;padding-top: 2px;" class="arrow icon-angle-left"></i></a>
							        <div class="collapse" style="overflow-y: hidden;" id="sample3">
  										<div class="card card-body">
						        			<a id="sd1" href="{{ route('histo') }}" style="border-bottom: 0px;border-top:0px;" class="list-group-item"><span style="padding-left: 22px;"><i id="i" class="icon-archive"></i>  Interventions</span></a>
						        			<a id="sd1" href="{{ route('reforme') }}" style="border-bottom: 0px;border-top:0px;" class="list-group-item"><span style="padding-left: 22px;"><i id="i" class="icon-fire"></i>  Reformes</span></a>
  										</div>
									</div>
							    <a  id="last" href="{{ route('planning') }}" class="list-group-item"><img src="{{ asset('assets/image/cal.png') }}"> <b>Planning</b></a>	        
      						</div>
						</div>
      					</div>
      					<div class="widget">
							<div style="border-color: #d9d9d9;margin-right:16px" class="widget-header">
								<i><h4 style="margin-left: 15px;margin-bottom: 0px;color:#334d63;padding-right: 3px; "> Statistique </h4></i>							
							</div>
							<div class="widget-content">
								<div class="list-group">
									<a id="first" href="#" class="list-group-item"><span id="notifier" class="label label-primary"><b id="not1">0</b></span> <b id="stat">Materiels</b></a>
						        	<a href="#" class="list-group-item"><span id="notifier2" class="label label-default"><b id="not3">0</b></span> <b id="stat">Utilisateurs</b></a>
						        	<a id="last" href="#" class="list-group-item"><span id="notifier3" class="label label-warning"><b id="not4">0</b></span> <b id="stat"> Prestataires</b></a>
      						</div>
							</div>
      					</div>
					</div>
				</div>
			</div>
		</div>
@endsection
@section('content')
		<div id="content" >
			<div class="container">
				<span id="pageIndex" hidden="hidden" class="activated">@if(isset($param))
					{{ $param }}
					@else 0 @endif</span>
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="#">Parc</a>
						</li>
						<li class="current">
							<a href="home" title="">Materiels</a>
						</li>
					</ul>
					<ul class="crumb-buttons">
						<li><a href="{{ route('planning') }}" title=""><i class="icon-list"></i><span>Planning</span></a></li>
						<li class="dropdown"><a href="#" title="" data-toggle="dropdown"><i class="icon-hdd"></i><span>Materiel </span><i class="icon-angle-down left-padding"></i></a>
							<ul class="dropdown-menu pull-right">
							<li><a href="{{ route('formAdd') }}" title=""><i class="icon-plus"></i>Nouveau</a></li>
							<li><a href="home" title=""><i class="icon-reorder"></i>Voir liste</a></li>
							</ul>
						</li>
						<li class=""><a href="#">
							<i class="icon-calendar"></i>
							<span>{{ date('d  M  Y') }}</span>
						</a></li>
					</ul>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<div class="widget box animated fadeInDown" >
							<div class="widget-header">
								<h4 id="titre"><i class="icon-hdd"></i> <span>@if(isset($nomCat))
								{{ $nomCat->categorie }}
							@else Materiels @endif</span></h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<div class="dataTables_wrapper form-inline" role="grid">
									<div class="row">
										<div class="dataTables_header clearfix">
											<div class="col-md-2">
												<div class="dataTables_length"><label><select id="const" size="1" aria-controls="DataTables_Table_3" class="select2-offscreen" tabindex="-1"><option id="init" value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">All</option></select> par page</label></div>
											</div>
										<div class="col-md-10">
											<div class="DTTT btn-group">	
												<a href="{{ URL::to('GeneratExcel/xlsx') }}" class="btn DTTT_button_xls"><span>Excel</span></a>	
											</div>
											<div class="dataTables_filter" id="filter"><label><div class="input-group"><span class="input-group-addon"><i class="icon-search"></i></span><input type="text" name="search" id="data_search" placeholder="search..." class="form-control"></div></label></div>
											<div class="DTTT btn-group" style="margin-right: 10px;">
												<a href="{{ route('formAdd') }}" class="btn DTTT_button"><span><i class="icon-plus"></i> Nouveau</span></a>
											</div>
											<div class="DTTT btn-group">
												<a href="#" class="btn DTTT_button del"><span><i class="icon-trash"></i> Supprimer</span></a>
											</div>
											<div style="width: 155px;" class="DTTT btn-group">
												<select id="sType" name="Type" class="select2 col-md-12 full-width-fix">
													<option value="0"> Selectionner type </option>
												 @isset($stype)	
													@foreach($stype as $st)
														<option value="{{ $st->id_catg }}"> {{ $st->categorie }} </option>
													@endforeach
												@endisset
											</select>
											</div>
										</div>
										<div id="processeur" class="dataTables_processing" style="visibility: hidden;">Processing...</div>
									</div>
								</div>
								<div id="ajax" style="padding-top: 0px;"><!-- 8px avant -->
								@include('Parc.materiel')
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="subMenu" style="overflow-y: scroll;">
			<div class="modal-dialog" style="width: 97%;margin-top: 0px;">
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
										<button style="padding: 4.5px 27px;" class="btn btn-sm" id="g3" type="button"><i class="icon-share"></i> Réforme</button>
									</span>
									<button style="padding: 4.5px 10px;" class="btn btn-sm pull-right" class="close" data-dismiss="modal" aria-hidden="true">Fermer</button>
								</div>
							</div>
					</div>
					<div class="row">
						<div class="col-md-3" style="padding-top: 8px;padding-right: 0px;">
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
												<div class="tabbable tabbable-custom customized" style="margin-right: 0px;margin-bottom: 0px;margin-top: -4px;">
													<ul class="nav nav-tabs hehehe">
														<li class="active"><a href="#tabe_f2" data-toggle="tab"><b>Maintenance</b></a></li>
														<li><a href="#tabe_f3" data-toggle="tab"><b>Reparation</b></a></li>
														<li ><a href="#tabe_f1" data-toggle="tab"><b>Affectation</b></a></li>
													</ul>
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
											Reforme
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
																</div>
															</div>
														</div>
														<div id="ajax_mtrace" style="padding-top: 0px;">
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
																</div>
															</div>
														</div>
														<div id="ajax_maint" style="padding-top: 0px;">
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
																</div>
															</div>
														</div>
														<div id="ajax_rep" style="padding-top: 0px;">
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
																</div>
															</div>
														</div>
														<div id="ajax_pan" style="padding-top: 0px;">
														</div>
													</div>
													</div>
												</div>
											</div>
										</div>
						</div>
					</div>
					<div style="height: 5px;padding: 0px;background:#ddd" class="modal-footer">
					</div>	
				</div>
			</div>
		</div>
@endsection