
@extends('layouts.app')

@section('content')

  <section class="jumbotron text-center">
    <div class="container">
      <h1>{{$country->title}}</h1>
      <h4>Atstumas</h4>
      <p class="lead text-muted">{{$country->distance}}<p>
      <h3>Aprašymas</h3>
      <p class="lead text-muted">{!!$country->description!!}<p>
      </p>
    </div>
  </section>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h6 class="p-md-3"><strong>Miestai: </strong></h6>
                <div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Pavadinimas</th>
							<th>Populiacija</th>
						</tr>
					</thead>
					@foreach ($country->towns as $town)
					<tr>
						<td>{{$town->title}}</td>
						<td>{{$town->population}}</td>
					</tr>
					@endforeach
					</table>

				</div>
            </div>
        </div>
</div>
@endsection
