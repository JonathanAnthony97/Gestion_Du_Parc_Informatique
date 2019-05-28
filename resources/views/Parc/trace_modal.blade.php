
<table class="table table-hover table-checkable">
									<thead>
										<tr>
											<th>Departement</th>
											<th>Utilisateur</th>
											<th>Date Affectation</th>
											<th class="align-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($trace as $t)
											<tr class="colorable">
												@if(isset($t->nom))
												
												<td>{{ $t->nom }}</td>
												<td>@if($t->prenom != null){{ $t->prenom }} @else Tous @endif</td>
												<td>
													{{ date('d-m-Y | H:i',strtotime($t->date_aff)) }}
												</td>
												
												
												<td class="align-center">
													<span class="btn-group">
														<a class="btn btn-xs" id="modifTrace" data-date="{{ date('Y-m-d H:i:s',strtotime($t->date_aff)) }}">
															<i class="icon-edit"></i>
														</a>
														<a  class="btn btn-xs" id="dellAff" data-id="{{ $t->id_histo }}" href="#">
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
											<div class="dataTables_info" id="ex_info">@if(isset($t->nom))Affichage {{ $a }} à {{ $b }} de  {{ $total }} entrées @endif</div>
										</div>
										<div class="col-md-8">
										
											<div class="dataTables_paginate paging_bootstrap pagin_mtrace">
												{{ $trace->links() }}
											</div>											
										</div>
									</div>
								</div>