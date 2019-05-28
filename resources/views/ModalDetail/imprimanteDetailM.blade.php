
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
										<td id="cld">Imprimante de type<span> : </span></td>
										<td>{{ $dt[0]->type_impr }}</td>
										<td id="cld">En couleur<span> : </span></td>
										<td>@if($dt[0]->couleur == "true") oui @else non @endif</td>
									</tr>
									<tr>
										
										<td id="cld">Fonction scan<span> : </span></td>
										<td>@if($dt[0]->fct_scan == "true") oui @else non @endif</td>
										<td id="cld">Fonction fax<span> : </span></td>
										<td>@if($dt[0]->fct_fax == "true") oui @else non @endif</td>
										<td id="cld">Fonction copie<span> : </span></td>
										<td>@if($dt[0]->fct_copy == "true") oui @else non @endif</td>
										<td id="cld">Carte reseau<span> : </span></td>
										<td colspan="3">@if($dt[0]->crt_reso == "true") oui @else non @endif</td>
									</tr>
								</tbody>
						</table>					
				</div>
			</div>
		