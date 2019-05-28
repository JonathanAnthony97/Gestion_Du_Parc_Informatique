<table class="table table-bordered table-hover table-checkable">
							<thead>
								<tr>
									<th>Materiel</th>
									<th>Acquisition</th>
									<th>Maintenance</th>
									<th>Reparation</th>
									<th>Vente</th>
							    </tr>
							</thead>
							<tbody>
								
								@foreach($done as $d)
								<tr>
									<td>{{ $d['type'] }}</td>
									<td>{{ $d['total_acqui'] }}</td>
									<td>{{ $d['total_maint'] }}</td>
									<td>{{ $d['total_rep'] }}</td>
									<td>{{ $d['total_vente'] }}</td>
								</tr>
								@endforeach
								<tr>
									<td><b>Total = {{ $totaux }} Ar</b></td>
									<td><b>{{ $som_acqui }}</b></td>
									<td><b>{{ $som_maint }}</b></td>
									<td><b>{{ $som_rep }}</b></td>
									<td><b>{{ $som_vente }}</b></td>
								</tr>
							</tbody>
						</table>