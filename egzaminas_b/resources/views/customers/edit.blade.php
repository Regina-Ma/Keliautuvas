@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Redaguoti klientą</div>

                <div class="card-body">
					@if(count($errors)!=0)
						<div class="alert alert-danger">
							<p>Formoje yra klaidų</p>
						</div>
					@endif
				
                <div class="card-body">

					
				<form action="{{route('customers.update', $customer->id)}}" method="post">
				@csrf
				@method('put')
				
						<div class="form-group">
							<label>Vardas</label> <input type="text" class="form-control @if ($errors->has('name')) border-danger @endif" name="name" value="{{$customer->name}}">
							@error('name')
						    	<small class="form-text text-muted alert-danger">{{$message}}</small>
							@enderror
						</div>
						<div class="form-group">
							<label>Pavardė</label> <input type="text" class="form-control @if ($errors->has('surname')) border-danger @endif" name="surname" value="{{$customer->surname}}">
							@error('surname')
						    	<small class="form-text text-muted alert-danger">{{$message}}</small>
							@enderror
						</div>
						<div class="form-group">
							<label>El. paštas</label> <input type="text" class="form-control @if ($errors->has('email')) border-danger @endif" name="email" value="{{$customer->email}}">
							@error('email')
						    	<small class="form-text text-muted alert-danger">{{$message}}</small>
							@enderror
						</div>
						<div class="form-group">
							<label>Telefonas</label> <input type="text" class="form-control @if ($errors->has('phone')) border-danger @endif" name="phone" value="{{$customer->phone}}">
							@error('phone')
						    	<small class="form-text text-muted alert-danger">{{$message}}</small>
							@enderror
						</div>
						<div class="form-group">
							<label>Šalis</label> 
							<select name="country_id" class="form-control @if ($errors->has('country_id')) border-danger @endif"> 
								@foreach ($countries as $country)
								<option value="{{$country->id}}" @if($customer->id==$customer->country_id)selected="selected" @endif  >{{$country->title}}</option> 
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
