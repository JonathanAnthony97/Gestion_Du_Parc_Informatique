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
    							
    							<a id="last" href="{{ route('util') }}" class="list-group-item">
    								<img src="{{ asset('assets/image/use.png') }}"> <b style="margin-left: 1px;">Utilisateur</b> </a>

      						</div>

      						<div class="list-group">
      							<a id="first" href="{{ route('bilan') }}" class="list-group-item"><img src="{{ asset('assets/image/bt.png') }}"> <b>Bilan</b></a>
      							<a  href="{{ route('invent') }}" class="list-group-item"><img src="{{ asset('assets/image/inve.png') }}">  <b>Inventaire</b></a>
      							
      							<a href="#" class="list-group-item g_m2 active" data-toggle="collapse" data-target="#sample3"><img src="{{ asset('assets/image/histo.png') }}"> <b>Historiques</b> <i style="float: right;padding-top: 2px;" class="arrow icon-angle-left"></i></a>
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
							<a href="home" title="">Materiels</a>
						</li>
						<li class="current">
							<a href="home" title="">Traçabilites</a>
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
					<div class="col-md-6">
						<div class="widget box animated fadeInDown" >
							<div class="widget-header">
								<h4 id="titre"><i class="icon-hdd"></i> <span>Statistique</span></h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content "><!--  no-padding-->
								<!-- datatable -->
								<div class="row">
									<div class="col-md-12">

										<div class="dataTables_wrapper form-inline" role="grid">
											<div class="row">
												<div class="dataTables_header clearfix">
													<div class="col-md-4">
														<div class="dataTables_length"><label><select id="const14" size="1" aria-controls="DataTables_Table_3" class="select2-offscreen" tabindex="-1"><option id="init" value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">All</option></select> par page</label></div>
													</div>

													<div class="col-md-8">
														<div class="DTTT btn-group">
												
														<a id="TotalPaneExcel" href="#" class="btn DTTT_button_xls"><span>Excel</span></a>
														
														</div>
														
														<div class="dataTables_filter" id="filter"><label><div class="input-group"><span class="input-group-addon"><i class="icon-search"></i></span><input type="text" name="search_histopan" id="data_search" class="form-control"></div></label>
														</div>
														
													</div>
													<div id="processeur20" class="dataTables_processing" style="visibility: hidden;">Processing...</div>
												</div>
											</div>
											<div id="ajax_histopan" style="padding-top: 5px;">
													@include('Parc.listHistoPane')
											</div>
										</div>
									</div>
									
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="widget box animated fadeInDown" >
							<div class="widget-header">
								<h4 id="titre"><i class="icon-hdd"></i> <span>Details Pannes</span></h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content "><!--  no-padding-->
								<!-- datatable -->
								<div class="row">
									<div class="col-md-12">
										<table class="table paneDetail">
											<tbody>
											<tr>
												<td class="titre">Departement<span> : </span></td>
												<td id="cont1"></td>
											</tr>
											<tr>
												<td class="titre">Numero de Serie<span> : </span></td>
												<td id="cont2"></td>
											</tr>
											<tr>
												<td class="titre">Marque<span> : </span></td>
												<td id="cont3"></td>
											</tr>
											<tr>
												<td class="titre">Type matériel<span> : </span></td>
												<td id="cont4"></td>
											</tr>
											<tr id="last">
												<td class="titre">Pannes recensées<span> : </span></td>
												<td id="cont5"></td>
											</tr>
									</tbody>
								</table>
									</div>
								</div>
									<br>
									<div class="row">
									<div class="col-md-12">
										<div class="dataTables_wrapper form-inline" role="grid">
											<div class="row">
												<div class="dataTables_header clearfix">
													<div class="col-md-4">
														<div class="dataTables_length"><label><select id="const15" size="1" aria-controls="DataTables_Table_3" class="select2-offscreen" tabindex="-1"><option id="init" value="5">5</option><option value="10">10</option><option value="25">25</option><option value="50">All</option></select> par page</label></div>
													</div>

													<div class="col-md-8">
														<div class="DTTT btn-group">
												
														<a id="HistoPaneExcel" href="#" class="btn DTTT_button_xls"><span>Excel</span></a>
														
														</div>
														
														<div class="dataTables_filter" id="filter"><label><div class="input-group"><span class="input-group-addon"><i class="icon-calendar"></i></span><input placeholder="entrer une date " type="text" name="search_detailpan" id="data_search" class="form-control"></div></label>
														</div>
														
													</div>
													<div id="processeur21" class="dataTables_processing" style="visibility: hidden;">Processing...</div>
												</div>
											</div>
											<div id="ajax_listPane" style="padding-top: 5px;">
													@include('Parc.listPane')
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					
					<!-- /Table with Footer -->
				</div>
			</div>
		</div>
				
@endsection




