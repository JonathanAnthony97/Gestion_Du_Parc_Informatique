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
								<td id="cld" >Maintenable tous les<span> : </span></td>
								<td id="cool">@isset($dt[0]->maintenable)
									{{ $dt[0]->maintenable }} mois
								@endisset</td>
								<td id="cld">Renouvellement<span> : </span></td>
								<td id="cool">@isset($dt[0]->date_renouv)
									{{ date('d-m-Y',strtotime($dt[0]->date_renouv)) }}
								@endisset</td>

								
								<td id="cld">Nom netbios<span> : </span></td>
								<td>{{ $dt[0]->netbios }}</td>
							
								@isset($dt[0]->ethernet)
								<td id="cld">Port ethernet<span> : </span></td>
								<td>{{ $dt[0]->ethernet }}</td>
								@endisset
								@isset($dt[0]->csl_port)
								<td id="cld">Port console<span> : </span></td>
								<td>{{ $dt[0]->csl_port }}</td>
								@endisset
							</tr>
							<tr>
								@isset($dt[0]->prenom)
								<td id="cld">Utilisateur<span> : </span></td>
								<td colspan="9">{{ $dt[0]->prenom }}
								@endisset</td>
							</tr>
						</tbody>
					</table>					
				</div>
			</div>
		</div>
	</td>
</tr>