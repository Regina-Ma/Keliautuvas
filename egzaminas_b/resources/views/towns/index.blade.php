
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Miestai</div>

                <div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Pavadinimas</th>
							<th>Populiacija</th>
							<th>Šalis</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					@foreach ($towns as $town)
					<tr>
						<td>{{$town->title}}</td>
						<td>{{$town->population}}</td>
						<td>{{$town->country->title}}</td>
						<td><a class="btn btn-info" href="{{route('towns.edit', $town->id)}}">Redaguoti</a></td>
						<td><form action="{{route('towns.destroy', $town->id)}}" method="post">
						@csrf
						@method('delete')
						<input type="submit" class="btn btn-danger" value="Ištrinti">
						</form></td>
					</tr>
					@endforeach
					</table>
				</div>
				<a href="{{route('towns.create')}}" class="btn btn-success">Pridėti naują miestą</a>
            </div>
        </div>
    </div>
</div>
@endsection
