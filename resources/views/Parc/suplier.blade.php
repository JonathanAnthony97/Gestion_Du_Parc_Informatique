<table class="table table-hover">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Adresse</th>
			<th>Contact</th>
			<th class="align-center">Action</th>
		</tr>
	</thead>
	<tbody id="suplier">
			@foreach($fsr as $f)
			<tr id="selectable" data-ligne="{{ $f->id_tier }}">
				<td>{{ $f->nom }}</td>
				<td>{{ $f->adr }}</td>
				<td>{{ $f->contact }}</td>
				<td class="align-center">
					<span class="btn-group">
						<a class="btn btn-xs" id="mater_fsr" data-id="{{ $f->id_tier }}" href="#">
							
								<i class="icon-hdd"></i>
							</a>
						<a class="btn btn-xs" id="modif_fsr" data-id="{{ $f->id_tier }}" href="#">
							
								<i class="icon-edit"></i>
							</a>
						<a  class="btn btn-xs" id="delFrs" data-id="{{ $f->id_tier }}" href="#">
							
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
				<div class="dataTables_info" id="ex_info">Affichage {{ $a2 }} à {{ $b2 }} de  {{ $total2 }} entrées</div>
			</div>
			<div class="col-md-8">
				<div class="dataTables_paginate paging_bootstrap pagin_fsr">
												{{ $fsr->links() }}
				</div>											
			</div>
		</div>
</div>