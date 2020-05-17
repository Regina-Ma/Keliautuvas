
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                	<div>Klientai</div>
                </div>
                <div class="card-body">
					<form class="container" action="{{route('customers.filter')}}" method="post">
					@csrf
  						<div class="row ">
  						<label class="ml-3 mr-3">Pasirinkti šalį:</label>
							<select name="country_id" class="col form-control ml-3 mr-3"> 
									<option value="0" @if($country_id==0)selected="selected" @endif>---</option>
								@foreach ($countries as $country)
									<option value="{{$country->id}}" name="{{$country->id}}" @if($country->id==$country_id)selected="selected" @endif>{{$country->title}}</option> 
								@endforeach
							</select>
                			<div class="col form-group">
                					<input name="submit" type="submit" class="btn btn-secondary" value="Filtruoti">
							</div>
						</div>		
					</form>
				</div>

                <div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Vardas</th>
							<th>Pavardė</th>
							<th>El. paštas</th>
							<th>Telefonas</th>
							<th>Šalis</th>
							<th>Kelionė</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					@foreach ($customers as $customer)
					<tr>
						<td>{{$customer->name}}</td>
						<td>{{$customer->surname}}</td>
						<td>{{$customer->email}}</td>
						<td>{{$customer->phone}}</td>						
						<td>{{$customer->country->title}}</td>
						<td><a class="btn btn-info" href="{{route('countries.show', $customer->country_id)}}">Peržiūrėti</a></td>
						<td><a class="btn btn-primary" href="{{route('customers.edit', $customer->id)}}">Redaguoti</a></td>
						<td><form action="{{route('customers.destroy', $customer->id)}}" method="post">
						@csrf
						@method('delete')
						<input type="submit" class="btn btn-danger" value="Ištrinti">
						</form></td>
					</tr>
					@endforeach
					</table>
				</div>
				<a href="{{route('customers.create')}}" class="btn btn-success">Pridėti naują klientą</a>
            </div>
        </div>
    </div>
</div>
@endsection
