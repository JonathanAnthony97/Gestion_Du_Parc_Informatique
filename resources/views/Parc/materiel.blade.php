
<table class="table table-bordered table-striped table-hover table-checkable">
									<thead>
										<tr>
											<th class="checkbox-column">
														<div class="checker">
															<span>
																<input id="checker_all" type="checkbox ">
															</span>
														</div>
											</th>
											<th style="text-align: center;padding-right:0px;padding-left: 0px;">Details</th>
											<th>N°Serie</th>
											<th>Marque</th>
											<th>Model</th>
											<th>Date Acquisition</th>
											<th>Fournisseur</th>
											<th>Etat</th>
											<th>Valeur Acquisition</th>
											<th class="align-center">Action</th>
										</tr>
									</thead>
									<tbody>
										  @foreach($ma as $m)
										<tr id="m" data-row="{{ $m->id_ma }}">
											<td class="checkbox-column">
												<div class="checker">
													<span id="s">
														<input id="checker" data-id="{{ $m->id_ma }}" type="checkbox">
													</span>
												</div>
											</td>
											<td id="togler" style="text-align: center;padding-top: 10px;padding-bottom: 4px;"><i style="font-size: 18px;" class="togle icon-double-angle-down"></i></td>
											<td>{{ $m->num_serie }}</td>
											<td>{{ $m->marque }}</td>
											<td>{{ $m->model }}</td>
											<td>{{ date('d-m-Y',strtotime($m->date_acqui)) }}</td>
											<td>{{ $m->nom }}</td>
											@if($m->etat == "En Panne")
											<td><i id="i_eta" style="color: #e25856" class="icon-sign-blank"></i>&nbsp; {{ $m->etat }}</td>
											@endif
											@if($m->etat == "En service")
											<td><i id="i_eta" style="color: #4d77cc" class="icon-sign-blank"></i>&nbsp; {{ $m->etat }}</td>
											@endif
											@if($m->etat == "Mauvais")
											<td><i id="i_eta" style="color: #f89406" class="icon-sign-blank"></i>&nbsp; {{ $m->etat }}</td>
											@endif
											@if($m->etat == "Inutilisé")
											<td><i id="i_eta" style="color: #94b86e" class="icon-sign-blank"></i>&nbsp; {{ $m->etat }}</td>
											@endif
											<td>{{ $m->vlr_acqui }}</td>
											<td class="align-center"><span class="btn-group">
												<a id="sub" data-id="{{ $m->id_ma }}" data-marque="{{ $m->marque }}" data-serie="{{ $m->num_serie }}" class="btn btn-xs" href="#">
													<i class="icon-th-list"></i>
												</a>

												<a class="btn btn-xs" href="{{ route('modifMa',$m->id_ma) }}">
													<i class="icon-edit"></i>
												</a>
												<a class="btn btn-xs" id="delMat" data-id="{{ $m->id_ma }}" href="#">
													<i class="icon-trash"></i>
												</a>
											</span></td>
										</tr>
										@endforeach
									</tbody>
								</table>
								<div class="row">
									<div class="table-footer">
										<div class="col-md-6">
											<div class="dataTables_info" id="ex_info">Affichage {{ $a }} à {{ $b }} de  {{ $total }} entrées</div>
										</div>
										<div class="col-md-6">

											<div class="dataTables_paginate paging_bootstrap pagin_ma">
												{{ $ma->links() }}
											</div>											
										</div>
									</div>
								</div>

