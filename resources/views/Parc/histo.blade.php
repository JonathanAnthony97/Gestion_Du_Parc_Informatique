
<table class="table table-striped table-bordered table-hover table-checkable">
									<thead>
										<tr>
											<th class="checkbox-column">
												<div class="checker">
													<span>
														<input id="checker_all" type="checkbox ">
													</span>		
												</div>
											</th>
											<th style="text-align: center">Detail</th>
											<th>N° Serie Materiel</th>
											<th>Prestataire</th>
											<th>Type</th>
											<th>Date</th>
											<th>Coût (Ar)</th>
											<th class="align-center">Action</th>
										</tr>
									</thead>
									<tbody>
										 @foreach($histo as $h)
										<tr data-ligne="{{ $h->id_inter }}">
											<td class="checkbox-column">
												<div class="checker">
													<span id="s">
														<input id="checker" data-id="{{ $h->id_inter }}" type="checkbox">
													</span>
												</div>
											</td>
											<td id="togler3" style="text-align: center;padding-top: 10px;padding-bottom: 4px;"><i style="font-size: 18px;" class="togle icon-double-angle-down"></i></td>
											<td>{{ $h->num_serie }}</td>
											<td>{{ $h->nom }}</td>
											<td>{{ $h->type_inter }}</td>
											<td>{{ date('d-m-Y',strtotime($h->date_inter)) }}</td>
											<td>{{ $h->cout_inter }}</td>
											<td class="align-center"><span class="btn-group">
													<a class="btn btn-xs" id="delHisto" data-id="{{ $h->id_inter }}" href="#">
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
											<div class="dataTables_paginate paging_bootstrap pagin_histo">
												{{ $histo->links() }}
											</div>											
										</div>
									</div>
								</div>
