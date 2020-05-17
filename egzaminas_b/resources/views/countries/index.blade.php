
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Šalys</div>

                <div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Pavadinimas</th>
							<th>Aprašymas</th>
							<th>Atstumas</th>
							<th>Miestai</th>
							<th>Veiksmai</th>
						</tr>
					</thead>
					@foreach ($countries as $country)
					<tr>
						<td>{{$country->title}}</td>
						<td>{!!$country->description!!}</td>
						<td>{{$country->distance}}</td>
						<td>{{$country->towns->count()}}</td>
						<td><form action="{{route('countries.destroy', $country->id)}}" method="post">
						@csrf
						@method('delete')
						<a class="btn btn-info" href="{{route('countries.edit', $country->id)}}">Redaguoti</a>
						<input type="submit" class="btn btn-danger" value="Ištrinti">
						</form></td>
					</tr>
					@endforeach
					</table>
				</div>
				<a href="{{route('countries.create')}}" class="btn btn-success">Pridėti naują šalį</a>
            </div>
        </div>
    </div>
</div>
@endsection
