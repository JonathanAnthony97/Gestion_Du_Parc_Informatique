<tr class="interv{{ $inter->id_inter }}">
	<td colspan="{{ $nbcol }}">
		<table class="table interDetail">
			<tbody>
				<tr>
					<td class="titre">Effectué par<span>&nbsp;&nbsp;:</span></td>
					<td>{{ $inter->nom  }} le <i style="color: #df5000;">{{ date('d M Y',strtotime($inter->date_inter)) }}</i></td>
				</tr>
				<tr>
					<td class="titre">Materiel<span>&nbsp;&nbsp;:</span></td>
					<td>{{ $stype->categorie }} {{ $inter->marque }} {{ $inter->model }} &nbsp;serie n° <i style="color: #df5000;">{{ $inter->num_serie}}</i></td>
				</tr>
				<tr>
					<td class="titre">Observation<span>&nbsp;&nbsp;:</span></td>
					<td>{{ $inter->description }}</td>
				</tr>
				@isset($inter->piece)
				<tr>
					<td class="titre">Pièce(s) <span>&nbsp;&nbsp;:</span></td>
					<td>{{ $inter->piece }}</td>
				</tr>
				@endisset
			</tbody>
		</table>
	</td>
</tr>