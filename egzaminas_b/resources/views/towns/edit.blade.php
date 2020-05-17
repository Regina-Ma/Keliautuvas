@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Redaguoti miestą</div>
					
					@if(count($errors)!=0)
						<div class="alert alert-danger">
							<p>Formoje yra klaidų</p>
						</div>
					@endif
					
                <div class="card-body">

					
				<form action="{{route('towns.update', $town->id)}}" method="post">
				@csrf
				@method('put')
				
						<div class="form-group">
							<label>Pavadinimas</label> <input type="text" class="form-control @if ($errors->has('title')) border-danger @endif" name="title" value="{{$town->title}}">
							@error('title')
						    	<small class="form-text text-muted alert-danger">{{$message}}</small>
							@enderror
						</div>
						<div class="form-group">
							<label>Populiacija</label> <input type="number" class="form-control @if ($errors->has('population')) border-danger @endif" name="population" value="{{$town->population}}">
							@error('population')
						    	<small class="form-text text-muted alert-danger">{{$message}}</small>
							@enderror
						</div>
						<div class="form-group">
							<label>Šalis</label> 
							<select name="country_id" class="form-control @if ($errors->has('country_id')) border-danger @endif"> 
								<option value="-1">Pasirinkti šalį:</option>
								@foreach ($countries as $country)
								<option value="{{$country->id}}" @if($country->id==$town->country_id)selected="selected" @endif  >{{$country->title}}</option> 
								@endforeach
							</select>
							@error('country_id')
						    	<small class="form-text text-muted alert-danger">{{$message}}</small>
							@enderror
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success">Atnaujinti</button>
						</div>
				
				</form>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
