


<table class="table table-hover table-striped table-bordered table-highlight-head">
									<thead>
										<tr>
											<th>#</th>
											<th>Username</th>
											<th>Email</th>
											<th>Created_at</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										  @foreach($user as $u)
										<tr>
											<td>{{ $u->id }}</td>
											<td>{{ $u->username }}</td>
											<td>{{ $u->email }}</td>

											<td>{{ date('d-m-Y  H:i',strtotime($u->created_at)) }}</td>
											<td><span class="label label-success">Approved</span></td>
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

											<div class="dataTables_paginate paging_bootstrap">
												{{ $user->links() }}
											</div>											
										</div>
									</div>
								</div>
