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
							<a href="{{route('home')}}" title="">Materiel</a>
						</li>
						<li class="current">
							<a href="#" title="">Ajout</a>
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
					<div class="col-md-11">
						<div class="widget box animated fadeInDown" style="border:0px;">
							<div class="widget-header" style="border-bottom: 0px;margin-top: 10px;">
								
								<div class="toolbar no-padding" style="float: left">
									<div class="btn-group">
										<!--<span class="btn btn-xs opener"><i class="icon-plus"></i></span>-->
										<span style="color: #555555;padding:3px 5px;margin-left: 34px;" class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
											 <b>&nbsp; Categorie Materiel&nbsp;&nbsp;&nbsp;<i class="icon-caret-down "></i></b> 
										</span>
										<ul id="ul_content" class="dropdown-menu pull-right">
											@isset($cat)
												@foreach($cat as $ca)
												<li id="act"><a id="typer" data-index="{{ $loop->index }}" data-id="{{ $ca->id_catg }}" href="#">@if($ca->categorie == "Reseau")
													<i class="icon-signal"></i>
													@elseif($ca->categorie == "Peripherique")
													<i class="icon-desktop"></i>
													@elseif($ca->categorie == "Ordinateur")
													<i class="icon-laptop"></i>
													@elseif($ca->categorie == "Electrique")
													<i class="icon-bolt"></i>
													@endif
													<span>{{ $ca->categorie }}</span></a></li>
												@endforeach
											@endisset
										</ul>
										
									</div>
								</div>
								<h4 style="margin-left: 20px;"> &nbsp;<span class="changer"> @isset($initial){{ $initial }} @endisset</span></h4>

							</div>
							<div class="widget-content form-widget"><!--  no-padding-->
								<div class="row" style="margin-top: 5px;margin-left: 20px;">
									<div class="col-md-12">
										<br>
										<form id="addMateriel" class="form-vertical row-border" method="post" action="{{ route('addMa') }}">
											{{ csrf_field() }}
											<fieldset class="fborder">
												<legend class="fborder"><i>Description Generale</i></legend>
													<div class="form-group" style="border-top:0px;margin-top: 10px;">
											<div class="row">

												<div class="col-md-3">
													<label for="a" class="control-label">Numero Serie :</label>
													<input id="a" type="text" name="numSerie" class="form-control">
													<label class="help-block a"></label>
												</div>

												<div class="col-md-3">
													<label for="b" class="control-label">Marque :</label>
													<input id="b" type="text"  name="marque" class="form-control">
													<label class="help-block b"></label>
												</div>

												<div class="col-md-3">
													<label for="c" class="control-label">Model :</label>
													<input id="c" type="text" name="model" class="form-control">
													<label class="help-block c"></label>
												</div>

												<div class="col-md-3">
													<label for="k" class="control-label">Type :&nbsp;&nbsp;&nbsp;<a id="modal3" href="#typeModal" data-toggle="modal"><i class="icon-plus-sign bs-tooltip " data-placement="top" data-original-title="Ajouter"></i></a></label>
													<input type="hidden" name="categParent">
													<input type="hidden" name="nomType">
												<select id="k" name="Type" class="select2 col-md-12 full-width-fix">
												<option value="0">Choix categorie</option>
													@isset($souCat)
														@foreach($souCat as $sou)
														<option value="{{ $sou->id_catg }}">{{ $sou->categorie }}</option>
														@endforeach
													@endisset
											</select>
											<label style="padding-top: 0px;" class="help-block k"></label>
											</div>

										</div>
									</div>
										<div class="form-group">
										<div class="row">

											

											<div class="col-md-3">
													<label for="d" class="control-label">Fournisseur :&nbsp;&nbsp;&nbsp;<a id="modal1" data-toggle="modal" href="#fournisseurModal"><i class="icon-plus-sign bs-tooltip" data-placement="top" data-original-title="Ajouter"></i></a></label>
													<select name="fournisseur" id="d" class="select2 col-md-12 full-width-fix">
													<option value="0">Choix fournisseur</option>
													@foreach($tiers as $tier)
													<option value="{{ $tier->id_tier}}">{{ $tier->nom }}</option>
													@endforeach
												</select>
												<label style="padding-top: 0px;" class="help-block d"></label>
												</div>

											<div class="col-md-3">
												<label for="e" class="control-label">Date Acquisition :</label>
												<div class="input-group">
													<input id="e" type="text" placeholder="dd-mm-yyyy hh:ii" name="dateAcquisition" class="form-control datepicker">
													<span class="input-group-addon"><i class="icon-calendar"></i></span>
												</div>
												<label class="help-block e"></label>
											</div>

											<div class="col-md-3">
												<label for="f" class="control-label">Valeur Acquisition (Ar) :</label>
												<input id="f" type="text" name="valeurAcquisition" class="form-control">
												<label class="help-block f"></label>
											</div>

											<div class="col-md-3">

												<label for="g" class="control-label">Garantie (Ans) :</label>
												<input id="g" type="text" name="garantie" class="form-control">
												<label class="help-block g"></label>
											</div>

										</div>
									</div>
									<div class="form-group">
										<div class="row">
											

											<div class="col-md-3">
												<label for="h" class="control-label">Departement :&nbsp;&nbsp;&nbsp;<a id="modal2" data-toggle="modal" href="#departementModal"><i class="icon-plus-sign bs-tooltip " data-placement="top" data-original-title="Ajouter"></i></a></label>
												<select id="h" name="departement" class="select2 col-md-12 full-width-fix">
												<option value="0">Choix departement</option>
													@foreach($deps as $dep)
														<option value="{{ $dep->id_dep }}">{{ $dep->nom }}</option>
													@endforeach
											</select>
											<label class="help-block h"></label>
											</div>

											<div class="col-md-3">
												<label for="af" class="control-label">Date Affectation :</label>
												<div class="input-group">
													<input id="af" type="text" placeholder="dd-mm-yyyy hh:ii" name="dateAffectation" class="form-control dateAff">
													<span class="input-group-addon"><i class="icon-calendar"></i></span>
												</div>
												<label class="help-block af"></label>
											</div>

											<div class="col-md-3">
												<label for="i_" class="control-label">Utilisateur :&nbsp;&nbsp;&nbsp;<a id="modal" href="{{ route('util') }}"><i class="icon-plus-sign bs-tooltip" data-placement="top" data-original-title="Ajouter"></i></a></label>
												<select id="i_" name="utilisateur" class="select2 col-md-12 full-width-fix">
													<option value="0">Choix utilisateur</option>
												</select>
											</div>

											<div class="col-md-3">
												<label for="j" class="control-label">Renouvellé après (Ans) :</label>
												<input id="j" type="text" placeholder="nombre d'année" name="duréeVie" class="form-control">
												<label class="help-block j"></label>
											</div>

										</div>
									</div>
									<div class="form-group">
										<div class="row">

											<div class="col-md-3">
												<label for="l1" class="control-label">Maintenable (mois) :</label>
												<input id="l1" type="text" placeholder="Nombre de mois" name="maintenable" class="form-control">
												<label class="help-block l1"></label>
											</div>

											<div class="col-md-3 variant">
												<label for="l" class="control-label">Nom (Netbios) :</label>
												<input id="l" type="text" name="netbios" class="form-control">
												<label class="help-block l"></label>
											</div>

											<div class="col-md-3 ethernet">
												<label for="eth" class="control-label">Nombre Ports Ethernet :</label>
												<input id="eth" type="text" name="ethernetPort" class="form-control">
												<label class="help-block eth"></label>
											</div>

											<div class="col-md-3 console">
												<label for="cons" class="control-label">Nombre Ports Console :</label>
												<input id="cons"  type="text" name="consolePort" class="form-control">
												<label class="help-block cons"></label>
											</div>

											<div class="col-md-3 intensite" style="display: none">
												<label for="int" class="control-label">Intensité (Amps):</label>
												<input id="int" type="text" name="intensite" class="form-control">
												<label class="help-block int"></label>
											</div>

										</div>
									</div>
									</fieldset>
									
									<div id="contentForm" style="margin-top: -10px;">
										<!--@include('Form.ordi')-->
									</div>
									<div class="form-actions" id="footerForm">

										<button type="submit" style="margin-right: 14px;" class="btn btn-primary pull-right"><i class="icon-pencil"></i> Enregistrer</button>
										<button type="reset" style="margin-right: 14px;" class="btn btn-default pull-right btn-reset"><i class="icon-refresh"></i> Reinitialiser</button>
									</div>
									<br>
								</form>
							</div>
						</div>
							</div>
						</div>
					</div>
					<!-- /Table with Footer -->
				</div>
			</div>
		</div>
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


		<!-- Modal dialog 
				departement -->
		<div class="modal fade" id="departementModal">
			<div class="modal-dialog" style="width: 600px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="icon-home"></i>&nbsp; Departement</h4>
					</div>
						<form id="addDep" action="{{ route('addDep') }}" method="post">
							{{ csrf_field() }}
							<div class="modal-body deprt">
								<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<label for="f4" class="control-label">Nom :</label>
												<input id="f4" type="text" name="nom" class="form-control">
												<label class="help-block f4"></label>
											</div>
											<div class="col-md-6">
												<label for="f5" class="control-label">Site :</label>			<input id="idSite" type="hidden" name="site">		
												<select id="f5" class="select2 col-md-12">
												<option value="0">Choix Site</option>
												<div id="site_content">
													@foreach($sites as $s)
													<option value="{{ $s->id_site }}">{{ $s->adresse }}</option>
													@endforeach
												</div>
												</select>
												<label style="padding-top: 0px;" class="help-block f5"></label>
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

		<!-- Modal dialog 
				categorie -->
		<div class="modal fade" id="categorieModal">
			<div class="modal-dialog" style="width: 300px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="icon-sitemap"></i>&nbsp; Categorie</h4>
					</div>
						<form action="{{ route('addCat') }}" id="addCat" method="post">
							{{ csrf_field() }}
							<div class="modal-body frs">
								<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<label for="f6" class="control-label">Libellé categorie :</label>
												<input id="f6" type="text" name="categorie" class="form-control">
												<label class="help-block f6"></label>
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

				<!-- Modal dialog 
				type -->
		<div class="modal fade" id="typeModal">
			<div class="modal-dialog" style="width: 300px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><i class="icon-sitemap"></i>&nbsp; Sous Gategorie :</h4>
					</div>
						<form id="addType" action="{{ route('addCat') }}" method="post">
							{{ csrf_field() }}
							<div class="modal-body frs">
								<div class="form-group">
										<div class="row">
											<div class="col-md-12 has-error">
												<label for="f7" class="control-label">Libellé categorie :</label>
												<input name="parent" type="hidden">
												<input id="f7" type="text" name="categorie" class="form-control">
												<label class="help-block f7"></label>
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

