
			<div class="row">
				<div class="col-md-12">
						<table id="detail" class="table model">
								<tbody>
									<tr>
										<td id="cld">Type<span> : </span></td>
										<td id="cool">{{ $type }}</td>
										<td id="cld">Garantie<span> : </span></td>
										<td>@isset($dt[0]->garantie)
											{{ $dt[0]->garantie.' ans' }}
										@endisset</td>
										<td id="cld">Departement<span> : </span></td>
										<td>{{ $dt[0]->nom }}</td>
										<td id="cld">Date d'Affectation<span> : </span></td>
										<td id="cool">@isset($dt[0]->date_aff)
											{{ date('d-m-Y',strtotime($dt[0]->date_aff)) }}
										@endisset</td>
										<td id="cld">Renouvelé après<span> : </span></td>
										<td>@isset($dt[0]->dure_vie)
											{{ $dt[0]->dure_vie }} ans
										@endisset</td>
																				
									</tr>
									<tr>
										<td id="cld">Maintenable tous les<span> : </span></td>
										<td id="cool">@isset($dt[0]->maintenable)
											{{ $dt[0]->maintenable }} mois
										@endisset</td>
										<td id="cld">Renouvellement<span> : </span></td>
										<td id="cool">@isset($dt[0]->date_renouv)
											{{ date('d-m-Y',strtotime($dt[0]->date_renouv)) }}
										@endisset</td>
										<td id="cld">Utilisateur<span> : </span></td>
										<td>@isset($dt[0]->prenom){{ $dt[0]->prenom }}@endisset</td>
										<td id="cld">Puissance<span> : </span></td>
										<td>@isset($dt[0]->puiss)
											{{ $dt[0]->puiss }} Kva @endisset</td>
										<td id="cld">Nombre phase<span> : </span></td>
										<td>{{ $dt[0]->phase }}</td>
									</tr>
									<tr>
										<td id="cld">Autonomie<span> : </span></td>
										<td>{{ $dt[0]->autonomi }}</td>
										<td id="cld">Batteries number<span> : </span></td>
										<td>{{ $dt[0]->nbBat }}</td>
										<td id="cld">Intensite<span> : </span></td>
										<td colspan="5">@isset($dt[0]->intesite)
											{{ $dt[0]->intesite }} Amps
										@endisset</td>
										
									</tr>
								</tbody>
						</table>					
				</div>
			</div>
		