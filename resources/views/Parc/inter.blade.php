<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th style="text-align: center;padding-right:0px;padding-left: 0px;">Detail</th>
			<th>Operation</th>
			<th>Date Intervention</th>
			<th>Coût(Ar)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="inter">
			@foreach($inter as $i)
			<tr id="selectable" data-ligne="{{ $i->id_inter }}">
				<td id="togler2" style="text-align: center;padding-top: 10px;padding-bottom: 4px;"><i style="font-size: 18px;" class="togle icon-double-angle-down"></i></td>
				<td>{{ $i->type_inter }}</td>
				<td>{{ date('d-m-Y',strtotime($i->date_inter)) }}</td>
				<td>{{ $i->cout_inter }}</td>
				<td class="align-center">
					<span class="btn-group">
						<a class="btn btn-xs" id="modif_inter" data-id="{{ $i->id_inter }}" href="#">
							
								<i class="icon-edit"></i>
							</a>
						<a  class="btn btn-xs" data-id="{{ $i->id_inter }}" href="#">
							
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
				<div class="dataTables_info" id="ex_info">Affichage {{ $a4 }} à {{ $b4 }} de  {{ $total4 }} entrées</div>
			</div>
			<div class="col-md-8">
				<div class="dataTables_paginate paging_bootstrap pagin_inter">
												{{ $inter->links() }}
				</div>											
			</div>
		</div>
</div>