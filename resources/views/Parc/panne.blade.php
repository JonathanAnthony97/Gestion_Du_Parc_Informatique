 
<table class="table table-hover table-checkable">
									<thead>
										<tr>
											<th>#</th>
											<th>Date Panne</th>
											<th>Description</th>
											<th class="align-center">Resolue</th>
											<th class="align-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($pans as $p)
											<tr class="colorable" id="pan{{ $p->id_pan }}">
												<td>P0{{ $loop->count - $loop->index }}</td>
												<td>
													{{ date('d-m-Y',strtotime($p->date_pan)) }}
												</td>
												<td>
													{{ $p->description }}
												</td>
												<td class="align-center">@if(isset($p->id_rp)) <i class="icon-ok"></i> @else <i class="icon-remove"></i> @endif</td>
																								
												<td class="align-center">
													<span class="btn-group">
														<a class="btn btn-xs" id="modifPan" data-num="{{ $loop->count - $loop->index }}" data-id="{{ $p->id_pan }}" href="#">
															<i class="icon-edit"></i>
														</a>
														<a class="btn btn-xs" id="delPane" data-id="{{ $p->id_pan }}" href="#">
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
										
											<div class="dataTables_paginate paging_bootstrap pagin_pan">
												{{ $pans->links() }}
											</div>											
										</div>
									</div>
								</div>