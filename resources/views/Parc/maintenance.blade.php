
<table class="table table-hover table-checkable">
									<thead>
										<tr>
											<th>Prestataire</th>
											<th>Date Maintenance</th>
											<th>Observation</th>
											<th>Coût (Ar)</th>
											<th class="align-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($maint as $m)
											<tr class="colorable" id="maint{{ $m->id_inter }}">
												<td>{{ $m->nom }}</td>
												<td>
													{{ date('d-m-Y',strtotime($m->date_inter)) }}
												</td>
												<td>
													{{ $m->description }}
												</td>
												<td>{{ $m->cout_inter }}</td>
																								
												<td class="align-center">
													<span class="btn-group">
														<a class="btn btn-xs" id="modifMain" data-id="{{ $m->id_inter }}" href="#">
															<i class="icon-edit"></i>
														</a>
														<a  class="btn btn-xs" id="delMainte" data-id="{{ $m->id_inter }}" href="#">
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
										
											<div class="dataTables_paginate paging_bootstrap pagin_maint">
												{{ $maint->links() }}
											</div>											
										</div>
									</div>
								</div>