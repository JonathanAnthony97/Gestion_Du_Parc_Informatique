<table class="table table-hover">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Adresse</th>
			<th>Email</th>
			<th>Tél Portable</th>
			<th>Tél Fix</th>
			<th class="align-center">Action</th>
		</tr>
	</thead>
	<tbody id="utilis">
		@foreach($ut as $u)
			<tr data-ligne="{{ $u->id_uti }}">
				<td>{{ $u->nom_u }}</td>
				<td>{{ $u->prenom }}</td>
				<td>{{ $u->adresse }}</td>
				<td>{{ $u->email  }}</td>
				<td>{{ $u->TelPort }}</td>
				<td>{{ $u->TelFix }}</td>
				<td class="align-center">
					<span class="btn-group">
						<a class="btn btn-xs" id="modif_uti" data-id="{{ $u->id_uti }}" href="#">
								<i class="icon-edit"></i>
							</a>
						<a class="btn btn-xs" id="delUti" data-id="{{ $u->id_uti }}" href="#">
								<i class="icon-trash"></i>
						</a>
					</span>
				</td>
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

				<div class="dataTables_paginate paging_bootstrap pagin_util">
												{{ $ut->links() }}
				</div>											
			</div>
		</div>
</div>