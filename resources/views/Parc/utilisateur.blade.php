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

        						<a id="first" class="list-group-item g_m" data-toggle="collapse" data-target="#sample1">
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
    							
    							<a id="last" href="{{ route('util') }}" class="list-group-item active">
    								<img src="{{ asset('assets/image/use.png') }}"> <b style="margin-left: 1px;">Utilisateur</b> </a>
      						</div>

      						<div class="list-group">
      							<a id="first" href="{{ route('bilan') }}" class="list-group-item"><img src="{{ asset('assets/image/bt.png') }}"> <b>Bilan</b></a>
      							<a  href="{{ route('invent') }}" class="list-group-item"><img src="{{ asset('assets/image/inve.png') }}">  <b>Inventaire</b></a>
      							
      							<a href="#" class="list-group-item g_m2" data-toggle="collapse" data-target="#sample3"><img src="{{ asset('assets/image/histo.png') }}"> <b>Historiques</b> <i style="float: right;padding-top: 2px;" class="arrow icon-angle-left"></i></a>
							        <div class="collapse" style="overflow-y: hidden;" id="sample3">
  										<div class="card card-body">
						        			<a id="sd1" href="{{ route('histo') }}" style="border-bottom: 0px;border-top:0px;" class="list-group-item"><span style="padding-left: 22px;"><i id="i" class="icon-archive"></i>  Interventions</span></a>
						        			<a id="sd1" href="{{ route('pane') }}" style="border-bottom: 0px;border-top:0px;" class="list-group-item"><span style="padding-left: 22px;"><i id="i" class="icon-ban-circle"></i>  Pannes</span></a>
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
									<a id="first" href="#" class="list-group-item"><span id="notifier" class="label label-primary"><b id="not1">0</b></span> <b>Materiels</b></a>

						        	<a href="#" class="list-group-item"><span id="notifier2" class="label label-default"><b id="not3">0</b></span> <b>Utilisateurs</b></a>
						        	
						        	<a id="last" href="#" class="list-group-item"><span id="notifier3" class="label label-warning"><b id="not4">0</b></span> <b> Prestataires</b></a>
      						</div>
							</div>
      					</div>
					</div>
				</div>

			</div>
			<!--<div id="divider"></div>-->
		</div>
@endsection
@section('content')
		<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="#">Parc</a>
						</li>
						<li>
							<a href="home" title="">Materiels</a>
						</li>
						<li class="current">
							<a href="{{ route('util') }}" title="">Utilisateurs</a>
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
					<!--=== Table with Footer ===-->
					<div class="col-md-12">
					
						<div class="tabbable tabbable-custom animated fadeInDown">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1" data-toggle="tab"><span id="tabs">Utilisateur</span></a></li>
								<li ><a href="#tab_2" data-toggle="tab"><span id="tabs">Fournisseur</span></a></li>
								<li><a href="#tab_3" data-toggle="tab"><span id="tabs">Prestataire</span></a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1" style="overflow-x: hidden;">
									<div class="row">
												
										<div class="col-md-12 util_contener">
											
											<form id="addUtilisateur" action="" method="post" class="form-horizontal" hidden style="border-bottom: 1px solid #ececec;">
												<div class="row">
													<br>
													<div class="col-md-3">
														<input type="hidden" name="idModif">
														{{ csrf_field() }}
														<div class="form-group">
														<label for="ser" class="col-md-4 control-label">Service:</label>
														<select id="ser" name="service" class="select2 col-md-7">
															<option value="0">Choix service</option>
														</select>
														<label style="padding-top: 0px;margin-bottom: 0px;" class="col-md-7 col-md-offset-4 help-block ser"></label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="nom" class="col-md-4 control-label">Nom:</label>
															<div class="col-md-8"><input class="form-control" type="text" id="nom" name="nom" placeholder="bollore"></div>
															<label style="padding-top: 0px;margin-bottom: 0px;" class="col-md-7 col-md-offset-4 help-block nom"></label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="prenom" class="col-md-4 control-label">Prenom:</label>
															<div class="col-md-8"><input class="form-control" type="text" id="prenom" name="prenom" placeholder="prenom"></div>
															<label style="padding-top: 0px;margin-bottom: 0px;" class="col-md-7 col-md-offset-4 help-block prenom"></label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
														<label for="adresse" class="col-md-4 control-label">Adresse:</label>
														<div class="col-md-8"><input class="form-control" type="text" id="adresse" name="adr" placeholder="tanjombato"></div>
														<label style="padding-top: 0px;margin-bottom: 0px;" class="col-md-7 col-md-offset-4 help-block adresse"></label>
														</div>
													</div>
													
												</div>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
														<label for="email" class="col-md-4 control-label">Email:</label>
														<div class="col-md-8"><input class="form-control" type="text" id="email" name="email" placeholder="bollore@mail.com"></div>
														<label style="padding-top: 0px;margin-bottom: 0px;" class="col-md-7 col-md-offset-4 help-block email"></label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="portab" class="col-md-4 control-label">TélPortable:</label>
															<div class="col-md-8"><input class="form-control" type="text" id="portab" name="telPortable" placeholder="0342154552"></div>
															<label style="padding-top: 0px;margin-bottom: 0px;" class="col-md-7 col-md-offset-4 help-block portab"></label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="fix" class="col-md-4 control-label">Tél Fix:</label>
															<div class="col-md-8"><input class="form-control" type="text" id="fix" name="telFix" placeholder="num tel fix"></div>
															<label style="padding-top: 0px;margin-bottom: 0px;" class="col-md-7 col-md-offset-4 help-block fix"></label>
														</div>
													</div>
													
													<div class="col-md-3">
														<div class="form-group">
															<div class="col-md-6"><button style="background-color: #4d7496;line-height: 0px;" type="submit" class="btn btn-sm btn-primary form-control">Sauver</button></div>
														<div class="col-md-6"><button style="line-height: 0px;" type="reset" class="btn btn-sm btn-default form-control reset_util">Annuler</button></div>
														</div>
													</div>
												</div>
											
											</form>
											
											<div class="dataTables_wrapper form-inline" role="grid">
												<div class="row">
													<div class="dataTables_header clearfix">
														<br>
														<div class="col-md-3">
															<div class="dataTables_length"><label><select id="const2" size="1" aria-controls="DataTables_Table_3" class="select2-offscreen" tabindex="-1"><option id="init" value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">All</option></select> par page</label></div>
														</div>

													<div class="col-md-9">
													<div class="DTTT btn-group">
														<a href="{{ URL::to('UtilExcel/xlsx') }}" class="btn DTTT_button_xls"><span>Excel</span></a>
													</div>
													<div class="dataTables_filter"><label><div style="width: 210px;" class="input-group"><span class="input-group-addon"><i class="icon-search"></i></span><input  type="text" name="search_uti" id="data_search" class="form-control"></div></label></div>
													<div class="DTTT btn-group" style="margin-right: 10px;">
												<a href="#" class="btn DTTT_button add_util"><span><i class="icon-plus"></i> Nouveau</span></a>
											</div>
													<div style="width: 170px;margin-right: 0px;" class="DTTT btn-group">
														<select id="departe" class="select2 col-md-12 full-width-fix">
															<option value="0"> Selectionner service </option>
															@foreach($ser as $s)
																<option value="{{ $s->id_dep }}">{{ $s->nom }}</option>
															@endforeach
														</select>
													</div>

												</div>
											<div id="processeur" class="dataTables_processing" style="visibility: hidden;">Processing...</div>
										</div>
									</div>

									<div id="ajax_uti" style="padding-top: 8px;">
										@include('Parc.util')
									</div>
								</div>
								</div>
								</div>
									
								</div>
								<div class="tab-pane" id="tab_2" style="overflow:hidden;">
									<div class="row">
										<div class="col-md-5">
											<form id="addFsr" hidden="hidden" action="{{ route('addTier') }}" method="post" style="margin-top: 10px;">
												<fieldset class="fborder">
													{{ csrf_field() }}
													<legend class="fbord"><i>Fomulaire Ajout</i></legend>
													<div class="row">
															<br>
														<div class="col-md-6">
															<div class="form-group">
															<div class="col-md-12"><input class="form-control" type="text" id="nom_fsr" name="nom" placeholder="Nom"></div>
															<label style="padding-top: 0px;margin-bottom: 0px;" class="col-md-12 help-block nom_fsr"></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
															<div class="col-md-12"><input class="form-control" type="text" id="adr_fsr" name="adresse" placeholder="Adresse"></div>
															<label style="padding-top: 0px;margin-bottom: 0px;" class="col-md-12 help-block adr_fsr"></label>
														</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
															<div class="col-md-12"><input class="form-control" type="text" id="cont_fsr" name="contact" placeholder="Contact"></div>
															<label style="padding-top: 0px;margin-bottom: 0px;" class="col-md-12 help-block cont_fsr"></label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<div class="col-md-6"><button style="background-color: #4d7496;line-height: 0px;" type="submit" class="btn btn-sm btn-primary form-control">Sauver</button></div>
																<div class="col-md-6"><button style="line-height: 0px;" type="resetAdfsr" class="btn btn-sm btn-default form-control reset_util">Annuler</button></div>
															</div>
														</div>
													</div>
												</fieldset>
											</form>

											<div class="widget" style="margin-top: 16px;margin-left: 10px;">
												<div class="widget-header">
													<h4><i class="icon-hdd"></i> &nbsp;<span style="font-size: 13px;">Materiels</span></h4>
													<div class="toolbar no-padding">
														<div class="btn-group">
															<span class="btn btn-xs refresh"><i class="icon-refresh"></i></span>
															
														</div>
														
													</div>
												</div>
												<div class="widget-content">
														<div class="scroller" data-height="430px" data-always-visible="1" data-rail-visible="0">
												<ul id="contener_m" class="feeds clearfix">
													@foreach($reso as $r)
														<li class="hoverable">
														<a href="#" data-id="{{ $r->id_ma }}">
														<div class="col1">
															<div class="content">
																<div class="content-col1">
																	<div class="label label-info">
																		<i class="icon-signal"></i>
																	</div>
																</div>
																<div class="content-col2">
																	<div class="desc">{{ $r->categorie }} {{ $r->marque }} {{ $r->model }}</div>
																</div>
																
															</div>
														</div> 
														<div class="col2">
															<div class="date">
																{{ date('M d, Y',strtotime($r->date_acqui)) }}
															</div>
														</div>
													</a>
													</li>
													@endforeach
													@foreach($ordi as $o)
													<li class="hoverable">
														<a href="#" data-id="{{ $o->id_ma }}">
														<div class="col1">
															<div class="content">
																<div class="content-col1">
																	<div class="label label-default">
																		<i class="icon-laptop"></i>
																	</div>
																</div>
																<div class="content-col2">
																	<div class="desc">{{ $o->categorie }} {{ $o->marque }} {{ $o->model }}</div>
																</div>
																
															</div>
														</div> 
														<div class="col2">
															<div class="date">
																{{ date('M d, Y',strtotime($o->date_acqui)) }}
															</div>
														</div>
													</a>
													</li>
													@endforeach
													@foreach($periph as $per)
													<li class="hoverable">
														<a href="#" data-id="{{ $per->id_ma }}">
														<div class="col1">
															<div class="content">
																<div class="content-col1">
																	<div class="label label-success">
																		<i class="icon-desktop"></i>
																	</div>
																</div>
																<div class="content-col2">
																	<div class="desc">{{ $per->categorie }} {{ $per->marque }} {{ $per->model }}</div>
																</div>
															</div>
														</div> 
														<div class="col2">
															<div class="date">
																{{ date('M d, Y',strtotime($per->date_acqui)) }}
															</div>
														</div>
													</a>
													</li>
													@endforeach
													@foreach($elec as $el)
													<li class="hoverable">
														<a href="#" data-id="{{ $el->id_ma }}">
														<div class="col1">
															<div class="content">
																<div class="content-col1">
																	<div class="label label-warning">
																		<i class="icon-bolt"></i>
																	</div>
																</div>
																<div class="content-col2">
																	<div class="desc">{{ $el->categorie }} {{ $el->marque }} {{ $el->model }}</div>
																</div>
																
															</div>
														</div> 
														<div class="col2">
															<div class="date">
																{{ date('M d, Y',strtotime($el->date_acqui)) }}
															</div>
														</div>
													</a>
													</li>
													@endforeach
													
													
												</ul> <!-- /.feeds -->
											</div> <!-- /.scroller -->
												</div>
      										</div>
										</div>
										<div class="col-md-7">
											<div class="widget-content">
												<div class="dataTables_wrapper form-inline" role="grid">
												<div class="row">
													<div class="dataTables_header clearfix">
														<br>
														<div class="col-md-4">
															<div class="dataTables_length"><label><select id="const3" size="1" aria-controls="DataTables_Table_3" class="select2-offscreen" tabindex="-1"><option id="init" value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">All</option></select> par page</label></div>
														</div>

													<div class="col-md-8">
													<div class="DTTT btn-group">
														<a href="{{ URL::to('FournisseurExcel/xlsx') }}" class="btn DTTT_button_xls"><span>Excel</span></a>
													</div>
													<div class="dataTables_filter"><label><div style="width: 210px;" class="input-group"><span class="input-group-addon"><i class="icon-search"></i></span><input  type="text" name="search_fsr" id="data_search" class="form-control"></div></label></div>
													<div class="DTTT btn-group" style="margin-right: 10px;">
												<a id="openModal" data-toggle="modal" href="#" class="btn DTTT_button"><span><i class="icon-plus"></i> Nouveau</span></a>
											</div>

												</div>
											<div id="processeur2" class="dataTables_processing" style="visibility: hidden;">Processing...</div>
										</div>
									</div>

									<div id="ajax_fsr">
										@include('Parc.suplier')
									</div>
								</div>
												</div> 
										
										</div>
										
									</div>
								</div>
								<div class="tab-pane" id="tab_3" style="overflow: hidden;">
									<div class="row">
										<div class="col-md-6">
											<div class="widget-content">

													<div class="dataTables_wrapper form-inline" role="grid">
												<div class="row">
													<div class="dataTables_header clearfix">
														<br>
														<div class="col-md-4">
															<div class="dataTables_length"><label><select id="const4" size="1" aria-controls="DataTables_Table_3" class="select2-offscreen" tabindex="-1"><option id="init" value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">All</option></select> par page</label></div>
														</div>

													<div class="col-md-8">
													<div class="DTTT btn-group">
														<a href="{{ URL::to('PrestatairExcel/xlsx') }}" class="btn DTTT_button_xls"><span>Excel</span></a>
													</div>
													<div class="dataTables_filter"><label><div style="width: 210px;" class="input-group"><span class="input-group-addon"><i class="icon-search"></i></span><input  type="text" name="search_prst" id="data_search" class="form-control"></div></label></div>
													<div class="DTTT btn-group" style="margin-right: 10px;">
												<a id="openModalPrst" data-toggle="modal" href="#" class="btn DTTT_button"><span><i class="icon-plus"></i> Nouveau</span></a>
											</div>

												</div>
											<div id="processeur3" class="dataTables_processing" style="visibility: hidden;">Processing...</div>
										</div>
									</div>

									<div id="ajax_prst">
										@include('Parc.prestataire')
									</div>
								</div>
												</div> 
										</div>
										<div class="col-md-6">
											<div class="widget-content">
													<div class="dataTables_wrapper form-inline" role="grid">
												<div class="row">
													<div class="dataTables_header clearfix">
														<br>
														<div class="col-md-4">
															<div class="dataTables_length"><label><select id="const5" size="1" aria-controls="DataTables_Table_3" class="select2-offscreen" tabindex="-1"><option id="init" value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">All</option></select> par page</label></div>
														</div>
													<div class="col-md-8">
													<div class="dataTables_filter"><label><div style="width: 210px;" class="input-group"><span class="input-group-addon"><i class="icon-search"></i></span><input  type="text" name="search_inter" id="data_search" class="form-control"></div></label></div>
													<div class="DTTT btn-group" style="margin-right: 10px;">
												<a id="refreshInter" href="#" class="btn DTTT_button"><span><i class="icon-refresh"></i> </span></a>
											</div>
											<input type="hidden" name="idTemp">
													
													</div>
												<div id="processeur4" class="dataTables_processing" style="visibility: hidden;">Processing...</div>
											</div>
										</div>

									<div id="ajax_inter">
										@include('Parc.inter')
									</div>
								</div>
												</div>
										</div>
									</div>
								</div>
							
							</div>
						</div>			
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="ModalDetail" style="top: 12%;background-color: #f9f9f9:">
			<div class="modal-dialog" style="width: 70%;">
				<div class="modal-content" style="background-color: #fff">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="icon-info"></i>&nbsp; Details</h4>
							
					</div>

					<div style="margin-top: 10px;margin-bottom: 25px;margin-left: 25px;margin-right: 25px" align="center" class="modal_contener"></div>	
					
						
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


				<!-- Modal dialog F
				fournisseaur -->
		<div class="modal fade" id="fournisseurModal">
			<div class="modal-dialog" style="width: 770px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="icon-shopping-cart"></i>&nbsp; Fournisseur</h4>
					</div>
						<form id="addTier" action="{{ route('addTier') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="typeForm" value="autre">
							<div class="modal-body frs">
								<div class="form-group">
										<div class="row">
											<div class="col-md-4">
												<label for="f1" class="control-label">Nom :</label>
												<input id="f1" type="text" name="nom" class="form-control">
												<label class="help-block f1"></label>
											</div>											
											<div class="col-md-4">
												<label for="f2" class="control-label">Contact :</label>
												<input id="f2" type="text" name="contact" class="form-control">
												<label class="help-block f2"></label>
											</div>
											<div class="col-md-4">
												<label for="f3" class="control-label">Adresse:</label>
												<input id="f3" type="text" name="adresse" class="form-control">
												<label class="help-block f3"></label>
											</div>
										</div>
									</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
								<button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Enregistrer</button>
							</div>
						</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="modal fade" id="prestataireModal">
			<div class="modal-dialog" style="width: 770px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="icon-male"></i>&nbsp; Prestataire</h4>
					</div>
						<form id="addPrest" action="{{ route('addPrest') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="idModPrst">
							<div class="modal-body frs">
								<div class="form-group">
										<div class="row">
											<div class="col-md-4">
												<label for="f1_p" class="control-label">Nom :</label>
												<input id="f1_p" type="text" name="nom" class="form-control">
												<label class="help-block f1_p"></label>
											</div>											
											<div class="col-md-4">
												<label for="f2_p" class="control-label">Contact :</label>
												<input id="f2_p" type="text" name="contact" class="form-control">
												<label class="help-block f2_p"></label>
											</div>
											<div class="col-md-4">
												<label for="f3_p" class="control-label">Adresse:</label>
												<input id="f3_p" type="text" name="adresse" class="form-control">
												<label class="help-block f3_p"></label>
											</div>
										</div>
									</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
								<button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Enregistrer</button>
							</div>
						</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="modal fade" id="fournisseurModif">
			<div class="modal-dialog" style="width: 770px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="icon-shopping-cart"></i>&nbsp; Modification</h4>
					</div>
						<form id="modTier" action="{{ route('updateTier') }}" method="post">
							{{ csrf_field() }}
							<div class="modal-body frs">
								<div class="form-group">
										<div class="row">
											<div class="col-md-4">

												<input type="hidden" name="id_fsr_modif">

												<label for="f1_" class="control-label">Nom :</label>
												<input id="f1_" type="text" name="nom" class="form-control">
												<label class="help-block f1_"></label>
											</div>											
											<div class="col-md-4">
												<label for="f2_" class="control-label">Contact :</label>
												<input id="f2_" type="text" name="contact" class="form-control">
												<label class="help-block f2_"></label>
											</div>
											<div class="col-md-4">
												<label for="f3_" class="control-label">Adresse:</label>
												<input id="f3_" type="text" name="adresse" class="form-control">
												<label class="help-block f3_"></label>
											</div>
										</div>
									</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
								<button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Enregistrer</button>
							</div>
						</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
				
@endsection




