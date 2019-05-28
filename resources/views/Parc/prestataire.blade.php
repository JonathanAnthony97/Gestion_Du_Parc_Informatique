<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Adresse</th>
			<th>Contact</th>
			<th class="align-center">Action</th>
		</tr>
	</thead>
	<tbody id="prestataire">
			@foreach($prest as $pr)
			<tr id="selectable" data-ligne="{{ $pr->id_tier }}">
				<td>{{ $pr->nom }}</td>
				<td>{{ $pr->adr }}</td>
				<td>{{ $pr->contact }}</td>
				<td class="align-center">
					<span class="btn-group">
						<a class="btn btn-xs" id="inter_prst" data-id="{{ $pr->id_tier }}" href="#">
							
								<i class="icon-time"></i>
							</a>
						<a class="btn btn-xs" id="modif_prst" data-id="{{ $pr->id_tier }}" href="#">
							
								<i class="icon-edit"></i>
							</a>
						<a  class="btn btn-xs" id="delPrest" data-id="{{ $pr->id_tier }}" href="#">
							
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
				<div class="dataTables_info" id="ex_info">Affichage {{ $a3 }} à {{ $b3 }} de  {{ $total3 }} entrées</div>
			</div>
			<div class="col-md-8">
				<div class="dataTables_paginate paging_bootstrap pagin_prest">
												{{ $prest->links() }}
				</div>											
			</div>
		</div>
</div>