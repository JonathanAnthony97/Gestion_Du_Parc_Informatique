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
							    <a  id="last" href="{{ route('planning') }}" class="list-group-item active"><img src="{{ asset('assets/image/cal.png') }}"> <b>Planning</b></a>
							       					        
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
		<div id="content" >
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="#">Parc</a>
						</li>
						<li>
							<a href="home" title="">Maintenance</a>
						</li>
						<li class="current">
							<a href="{{ route('suivi') }}">Planning</a>
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
				<div class="row animated fadeInDown">
					
						
						<!--<a href="{{ route('calendar') }}" class="btn btn-sm btn-primary">Reinit</a> /Calendar -->
						<div class="col-md-4">
							
							<div class="widget">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Tâches</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
										<span class="btn btn-xs widget-refresh"><i class="icon-refresh"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<div class="tabbable tabbable-custom">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#tab_feed_1" data-toggle="tab"><b>Materiels</b></a></li>
										<li><a href="#tab_feed_2" data-toggle="tab"><b><i class="icon-plus"></i>  Nouveau</b></a></li>
										<li><a href="#tab_feed_3" data-toggle="tab"><b>Alert</b></a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="tab_feed_1">
											<div class="scroller" data-height="418px" data-always-visible="1" data-rail-visible="0">
												<ul class="feeds clearfix contentMaint">

												
												</ul> <!-- /.feeds -->
											</div> <!-- /.scroller -->
										</div> <!-- /#tab_feed_1 -->

										<div class="tab-pane" id="tab_feed_2" style="overflow: hidden;">
												<form id="addMaint" method="post" action="{{ route('maintenance') }}" class="form-vertical">
													{{ csrf_field() }}
													<input type="hidden" name="id_mat">
															<div class="row" style="margin-right:0px;padding-left:16px;margin-top: 8px;margin-bottom: 8px;">
																	<div class="col-md-10 col-md-offset-1">
																		<label id="lb" for="traitant" class="control-label pull-left">Materiel
																		</label>
																		<br>
																		<input id="matCible" style="background: #fff;color: #555;" readonly class="form-control" placeholder="materiel à maintenir">
																	</div>
																</div>
																<div class="row" style="margin-right:0px;padding-left:16px;margin-top: 8px;margin-bottom: 8px;">
																	<div class="col-md-10 col-md-offset-1">
																		<label id="lb" for="traitant" class="control-label pull-left">Prestataire
																		</label>
																		<br>
																		<select id="traitant" name="prestataire" class="select2 col-md-12">
																			<option value="0">Selectionner</option>
																		</select>
																		<label id="lb_er" class="help-block traitant"></label>
																	</div>
																</div>
																
																<div class="row" style="margin-right:0px;padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-10 col-md-offset-1">
																		<label id="lb" for="dmain" class="control-label pull-left">Date Maintenance
																		</label>
																		<br>
																		<div class="input-group">
																			<input id="dmain" name="dateMaintenance" class="form-control daty_main" placeholder="dd-mm-yyyy"><span class="input-group-addon"><i class="icon-calendar"> </i></span>
																		</div>
																		<label id="lb_er" class="help-block dmain"></label>
																	</div>
																</div>
																<div class="row" style="margin-right:2px;padding-left:16px;margin-bottom: 8px;">
																	<div class="col-md-10 col-md-offset-1">
																		<label id="lb" for="obs" class="control-label pull-left">Observation
																		</label>
																		<br>
																		<textarea id="obs" name="observation" style="overflow-y: hidden;" class="form-control">
																		</textarea>
																		<label id="lb_er" class="help-block obs"></label>
																	</div>
																</div>
																<div class="row" style="margin-right:0px;padding-left:16px;">
																	<div class="col-md-10 col-md-offset-1">
																		<label id="lb" for="cout" class="control-label pull-left">Coût (Ar)
																		</label>
																		<br>
																		<input id="cout" name="cout" class="form-control" placeholder="">
																		<label id="lb_er" class="help-block cout"></label>
																	</div>
																</div>
																<button id="resetf" style="margin-left: 50px;margin-top: 13px;margin-bottom: 20px;" class="btn btn-sm  pull-left" type="reset"><i class="icon-refresh"></i> Reset</button>
																<button disabled style="margin-right: 48px;margin-top: 13px;margin-bottom: 20px;" class="btn btn-sm  pull-right" type="submit"><i class="icon-check"></i> Sauver</button>
															</form>
											
										</div> <!-- /#tab_feed_1 -->
										<div class="tab-pane" id="tab_feed_3">
											<div class="scroller" data-height="418px" data-always-visible="1" data-rail-visible="0">
												<ul class="feeds clearfix contAlert">
													
												</ul> <!-- /.feeds -->
											</div> <!-- /.scroller -->

											
										</div> <!-- /#tab_feed_1 -->
									</div> <!-- /.tab-content -->
								</div> <!-- /.tabbable tabbable-custom-->
							</div> <!-- /.widget-content -->
						</div> <!-- /.widget .box -->
						</div>
						<!--=== Table with Footer ===-->
						<!--=== Calendar ===-->
						<div class="col-md-7">
							<div class="widget ">
							<div class="widget-content">
									<div id="calendar"></div>
								</div>
								
							</div>
						</div> <!-- /.widget box -->
					</div>
					
					<!-- /Table with Footer -->
				</div>
			</div>
		</div>
@endsection




