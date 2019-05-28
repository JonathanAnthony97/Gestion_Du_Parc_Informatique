
<table class="table table-bordered table-striped table-hover table-checkable">
									<thead>
										<tr>
											<th>Departement</th>
											<th>Type</th>
											<th>Marque</th>
											<th>Model</th>
											<th>N° Serie</th>
											<th>Utilisateur</th>
											<th>Date Acquisition</th>
											<th>Fournisseur</th>
											<th>Valeur Acquisition (Ar)</th>
											<th>Garantie (Ans)</th>
											<th>Etat</th>
											<th class="align-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($invent as $i)
											<tr>
												@if(isset($i->nom))
													<td>{{ $i->nom }}</td>
												@else
													<td class="align-center"> <b>---</b> </td>
												@endif
												<td>{{ $i->categorie }}</td>
												<td>{{ $i->marque }}</td>
												<td>{{ $i->model }}</td>
												<td>{{ $i->num_serie }}</td>
												@if(isset($i->user))
													<td>{{ $i->user }}</td>
												@else
													<td class="align-center"> <b>---</b> </td>
												@endif
												<td>{{ date('d-m-Y',strtotime($i->date_acqui)) }}</td>
												<td>{{ $i->suplier }}</td>
												<td>{{ $i->vlr_acqui }}</td>
												<td>{{ $i->garantie }}</td>
												<td>{{ $i->etat }}</td>
												<td class="align-center">
													<span class="btn-group">
														<a  class="btn btn-xs" href="{{ route('modifMa',$i->id_ma) }}">
															<i  class="icon-edit"></i>
														</a>
														<a  class="btn btn-xs" id="delInvent" data-id="{{ $i->id_ma }}">
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
										
											<div class="dataTables_paginate paging_bootstrap pagin_invent">
												{{ $invent->links() }}
											</div>											
										</div>
									</div>
								</div>