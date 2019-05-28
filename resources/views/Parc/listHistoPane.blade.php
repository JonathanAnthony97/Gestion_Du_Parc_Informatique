
<table class="table table-bordered table-checkable">
									<thead>
										<tr>
											<th>Departement</th>
											<th>Type</th>
											<th>N° Serie</th>
											<th>Marque</th>
											<th>Pannes</th>
											<th class="align-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($trace as $t)
											<tr id="tr_colorable" data-id="{{ $t['id_ma'] }}">
												@if(isset($t['Departement']))
												<td data-dep="{{ $t['Departement'] }}" id="dep">{{ $t['Departement'] }}</td>
												@else
												<td id="dep" data-dep="Non affecté">Non affecté</td>
												@endif
												<td data-type="{{ $t['Type'] }}" id="type">{{ $t['Type'] }}</td>
												<td data-serie="{{ $t['Numero_Serie'] }}" id="serie">{{ $t['Numero_Serie'] }}</td>
												<td data-marque="{{ $t['Marque'] }}" id="marque">{{ $t['Marque'] }}</td>
												<td data-pane="{{ $t['Pannes'] }}" id="pane">{{ $t['Pannes'] }}</td>
												<td class="align-center">
													<span class="btn-group">
														<a class="btn btn-xs" id="histoPane" data-id="{{ $t['id_ma'] }}">
															voir
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
										
											<div class="dataTables_paginate paging_bootstrap pagin_histopane">
												{{ $trace->links() }}
											</div>											
										</div>
									</div>
								</div>