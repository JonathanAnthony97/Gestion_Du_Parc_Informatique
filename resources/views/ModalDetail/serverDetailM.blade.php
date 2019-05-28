
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
										<td id="cld">Nom netbios<span> : </span></td>
										<td>{{ $dt[0]->netbios }}</td>
										<td id="cld">Adresse Ip<span> : </span></td>
										<td>{{ $dt[0]->ipAdr }}</td>
									</tr>
									<tr>
										<td id="cld">Processors number<span> : </span></td>
										<td>{{ $dt[0]->nbProces }}</td>
										<td id="cld">CPU model<span> : </span></td>
										<td>{{ $dt[0]->model_cpu }}</td>
										<td id="cld">CPU frequency<span> : </span></td>
										<td>@isset($dt[0]->frequences)
											{{ $dt[0]->frequences }} Ghz
										@endisset</td>
										<td id="cld">Chipset number<span> : </span></td>
										<td>{{ $dt[0]->memoChips }}</td>
										<td id="cld">Memory type<span> : </span></td>
										<td>{{ $dt[0]->type_memo }}</td>
									</tr>
									<tr>
										<td id="cld">Memory overall size<span> : </span></td>
										@isset($dt[0]->total)
										<td>{{ $dt[0]->total }} Gbytes</td>
										@endisset
										<td id="cld">Nombre Disque dur<span> : </span></td>
										<td>{{ $dt[0]->nbDisk }}</td>
										<td id="cld">Type Disque dur<span> : </span></td>
										<td>{{ $dt[0]->type_disk }}</td>
										<td id="cld">Taille par disque<span> : </span></td>
										@isset($dt[0]->taille_par_disk)
										<td>{{ $dt[0]->taille_par_disk }} Gbytes</td>
										@endisset
										<td id="cld">RAID type<span> : </span></td>
										<td>{{ $dt[0]->type_raid }}</td>
									</tr>
									<tr>
										<td id="cld">Ports ethernet<span> : </span></td>
										<td>{{ $dt[0]->ethernet }}</td>
										<td id="cld">Ports console<span> : </span></td>
										<td>{{ $dt[0]->csl_port }}</td>
										<td id="cld">Utilisation<span> : </span></td>
										<td colspan="5">{{ $dt[0]->utilisation }}</td>
									</tr>
								</tbody>
						</table>					
				</div>
			</div>
	