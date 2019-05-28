
			<div class="row">
				<div class="col-md-12">
						<table id="detail2" class="table model">
								<tbody>
									<tr>
										<td id="cld">Type</td>
										<td>: &nbsp;{{ $type }}</td>
										<td id="cld">Garantie</td>
										<td>: &nbsp;@isset($dt[0]->garantie)
											{{ $dt[0]->garantie.' ans' }}
										@endisset</td>
										<td id="cld">Departement</td>
										<td>: &nbsp;{{ $dt[0]->nom }}</td>
										<td id="cld">Date d'Affectation</td>
										<td>: &nbsp;@isset($dt[0]->date_aff)
											{{ date('d-m-Y',strtotime($dt[0]->date_aff)) }}
										@endisset</td>
										<td id="cld">Durée de Vie</td>
										<td>: &nbsp;@isset($dt[0]->dure_vie)
											{{ $dt[0]->dure_vie }} ans
										@endisset</td>
																				
									</tr>
									<tr>
										<td id="cld">Maintenable tous les</td>
										<td>: &nbsp;@isset($dt[0]->maintenable)
											{{ $dt[0]->maintenable }} mois
										@endisset</td>
										<td id="cld">Renouvellement</td>
										<td>: &nbsp;@isset($dt[0]->date_renouv)
											{{ date('d-m-Y',strtotime($dt[0]->date_renouv)) }}
										@endisset</td>
										<td id="cld">Utilisateur</td>
										<td>: &nbsp;@isset($dt[0]->prenom){{ $dt[0]->prenom }}@endisset</td>
										<td id="cld">Disque dur</td>
										<td>: &nbsp;{{ $dt[0]->nbDisk }}</td>
										<td id="cld">Type Disque dur</td>
										<td>: &nbsp;{{ $dt[0]->type_disk }}</td>
									</tr>
									<tr>
										<td id="cld">Taille par disque</td>
										<td>: &nbsp;{{ $dt[0]->taille_par_disk }}</td>
										<td id="cld">RAID type</td>
										<td>: &nbsp;{{ $dt[0]->type_raid }}</td>
									</tr>
								</tbody>
						</table>					
				</div>
			</div>
			