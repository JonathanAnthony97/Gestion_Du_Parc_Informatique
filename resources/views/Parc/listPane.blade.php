
<table class="table table-bordered table-striped table-hover table-checkable">
									<thead>
										<tr>
											<th>Date panne</th>
											<th>Description</th>
											<th class="align-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@isset($pane)
										@foreach($pane as $p)
											<tr>
												<td>{{ $p->date_pan }}</td>
												<td>{{ $p->description }}</td>
												<td class="align-center">
													<span class="btn-group">
														<a class="btn btn-xs" id="DeletePane" data-id="{{ $p->id_pan }}">
															supprimer
														</a>
													</span>
												</td>
											</tr>
										@endforeach
										@endisset
									</tbody>
								</table>
								<div class="row">
									<div class="table-footer">
										<div class="col-md-4">
											<div class="dataTables_info" id="ex_info">Affichage @if(isset($a1)) {{ $a1 }} à {{ $b1 }} de  {{ $total1 }} entrées @else 0 à 0 de 0 entrées @endif  </div>
										</div>
										<div class="col-md-8">
										
											<div class="dataTables_paginate paging_bootstrap pagin_detailPane">
												@isset($pane) {{ $pane->links() }} @endisset
											</div>											
										</div>
									</div>
								</div>