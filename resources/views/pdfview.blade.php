<style type="text/css">

	table td, table th{

		border:1px solid black;


	}

</style>

<div class="container">

	<table>

		<tr>

			<th>No</th>

			<th>Username</th>

			<th>Email</th>

		</tr>

		@foreach ($users as $key => $item)

		<tr>

			<td>{{ ++$key }}</td>

			<td>{{ $item->username }}</td>

			<td>{{ $item->email }}</td>

		</tr>

		@endforeach

	</table>

</div>