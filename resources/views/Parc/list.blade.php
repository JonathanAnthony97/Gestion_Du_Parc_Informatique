
<table class="table table-bordered table-striped table-hover table-checkable">
									<thead>
										<tr>
											<th>N° Serie</th>
											<th>Type</th>
											<th>Marque</th>
											<th>Model</th>
											<th>Date Affectation</th>
											<th>Departement</th>
											<th>Utilisateur</th>
											<th class="align-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($trace as $t)
											<tr>
												
												<td>{{ $t->num_serie }} </td>
												<td>{{ $t->categorie }}</td>
												<td>{{ $t->marque }}</td>
												<td>{{ $t->model }}</td>
												@if(isset($t->nom))
												<td>
													{{ date('d-m-Y | H:i',strtotime($t->date_aff)) }}
												</td>
												<td>{{ $t->nom }}</td>
												<td>@if($t->prenom != null){{ $t->prenom }} @else Tous @endif</td>
												<td class="align-center">
													<span class="btn-group">
														
														<a class="btn btn-xs" id="SupTrace" data-id="{{ $t->id_histo }}">
															<i  class="icon-trash"></i>
														</a>
													</span>
												</td>
												@else
												<td class="align-center">-</td>
												<td class="align-center">-</td>
												<td class="align-center">-</td>
												<td class="align-center">
													<span class="btn-group">
														
														<a disabled class="btn btn-xs" id="" data-id="">
															<i  class="icon-trash"></i>
														</a>
													</span>
												</td>
												@endif
												
												
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
										
											<div class="dataTables_paginate paging_bootstrap pagin_trace">
												{{ $trace->links() }}
											</div>											
										</div>
									</div>
								</div>