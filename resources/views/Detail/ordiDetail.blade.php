<tr class="open{{ $id_ma }}">
	<td colspan="10">
		<div class="table-detail">
			<div class="row">
				<div class="col-md-12">
						<table id="detail" class="table table-bordered">
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
										<td>@isset($dt[0]->netbios){{ $dt[0]->netbios }}@endisset</td>
										<td id="cld">OS type<span> : </span></td>
										<td>@isset($dt[0]->type_os){{ $dt[0]->type_os }}@endisset</td>
									</tr>
									<tr>
										<td id="cld">OS language<span> : </span></td>
										<td>@isset($dt[0]->lang_os){{ $dt[0]->lang_os }}@endisset</td>
										<td id="cld">OS Service pack<span> : </span></td>
										<td>@isset($dt[0]->srv_pack){{ $dt[0]->srv_pack }}@endisset</td>
										<td id="cld">Monitor marker<span> : </span></td>
										<td>@isset($dt[0]->mrk){{ $dt[0]->mrk }}@endisset</td>
										<td id="cld">Monitor model<span> : </span></td>
										<td>@isset($dt[0]->modele){{ $dt[0]->modele }}@endisset</td>
										<td id="cld">Monitor N°Serie<span> : </span></td>
										<td>@isset($dt[0]->numSer){{ $dt[0]->numSer }}@endisset</td>
									</tr>
									<tr>
										<td id="cld">Processors number<span> : </span></td>
										<td>@isset($dt[0]->nbProces){{ $dt[0]->nbProces }}@endisset</td>
										<td id="cld">CPU model<span> : </span></td>
										<td>@isset($dt[0]->model_cpu){{ $dt[0]->model_cpu }}@endisset</td>
										<td id="cld">CPU frequency<span> : </span></td>
										<td>@isset($dt[0]->frequences)
											{{ $dt[0]->frequences }} Ghz
										@endisset</td>
										<td id="cld">Chipset number<span> : </span></td>
										<td>@isset($dt[0]->memoChips){{ $dt[0]->memoChips }}@endisset</td>
										<td id="cld">Memory type<span> : </span></td>
										<td>@isset($dt[0]->type_memo){{ $dt[0]->type_memo }}@endisset</td>
									</tr>
									<tr>
										<td id="cld">Memory overall size<span> : </span></td>
										<td>@isset($dt[0]->total)
											{{ $dt[0]->total }} Gbytes
											@endisset</td>
										<td id="cld">Disque dur<span> : </span></td>
										<td>@isset($dt[0]->nbDisk){{ $dt[0]->nbDisk }}@endisset</td>
										<td id="cld">Type Disque dur<span> : </span></td>
										<td>@isset($dt[0]->type_disk){{ $dt[0]->type_disk }}@endisset</td>
										<td id="cld">Taille par disque<span> : </span></td>
										<td>@isset($dt[0]->taille_par_disk)
											{{ $dt[0]->taille_par_disk }} Gbytes
											@endisset</td>
									</tr>
								</tbody>
						</table>					
				</div>
			</div>
		</div>
	</td>
</tr>