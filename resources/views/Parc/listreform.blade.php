
<table class="table table-bordered table-striped table-hover table-checkable">
									<thead>
										<tr>
											<th>N° Serie</th>
											<th>Type</th>
											<th>Marque</th>
											<th>Date Acquisition</th>
											<th>Fournisseur</th>
											<th>Date Réforme</th>
											<th>Réforme</th>
											<th>Acheteur</th>
											<th>Donataire</th>
											<th>Prix Vente</th>
											<th class="align-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($ref as $r)
											<tr>
												<td>{{ $r->num_serie }}</td>
												<td>{{ $r->type }}</td>
												<td>{{ $r->marque }}</td>
												<td>{{ date('d-m-Y',strtotime($r->date_acqui)) }}</td>
												<td>{{ $r->nom }}</td>
												<td>{{ date('d-m-Y',strtotime($r->date_reform)) }}</td>
												
												<td>{{ $r->type_rf }}</td>
												<td class="align-center">
													@if(isset($r->acheteur)) {{ $r->acheteur }} @else - @endif
												</td>
												<td class="align-center">
													@if(isset($r->donataire)) {{ $r->donataire }} @else - @endif
												</td>
												<td class="align-center">@if(isset($r->valeur)) {{ $r->valeur }} @else -  @endif</td>
											
												<td class="align-center">
													<span class="btn-group">
														<a  class="btn btn-xs" id="delReform" data-id="{{ $r->id_rf }}" href="#">
															<i  class="icon-trash"></i>
														</a>
													</span>
												</td>
												
											</tr>
										@endforeach
									</tbody>
								</table>
								<div class="row">
									<div class="table-footer">
										<div class="col-md-4">
											<div class="dataTables_info" id="ex_info">Affichage {{ $a }} à {{ $b }} de  {{ $total }} entrées </div>
										</div>
										<div class="col-md-8">
										
											<div class="dataTables_paginate paging_bootstrap pagin_reform">
												{{ $ref->links() }}
											</div>											
										</div>
									</div>
								</div>