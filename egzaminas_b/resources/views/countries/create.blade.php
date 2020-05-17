@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pridėti naują šalį</div>

                <div class="card-body">
					@if(count($errors)!=0)
						<div class="alert alert-danger">
							<p>Formoje yra klaidų</p>
						</div>
					@endif
					
				<form action="{{route('countries.store')}}" method="post">
				@csrf
				
						<div class="form-group">
							<label>Pavadinimas</label> <input type="text" class="form-control @if ($errors->has('title')) border-danger @endif" name="title" value="{{old('title')}}">
							@error('title')
						    	<small class="form-text text-muted alert-danger">{{$message}}</small>
							@enderror
						</div>
						<div class="form-group">
							<label>Aprašymas</label> <textarea id="tinymcetext" rows="10" col="" class="form-control" name="description" value="{{old('description')}}"></textarea>
						</div>
						<div class="form-group">
							<label>Atstumas</label> <input type="number" class="form-control @if ($errors->has('distance')) border-danger @endif" name="distance"  value="{{old('distance')}}">
							@error('distance')
						    	<small class="form-text text-muted alert-danger">{{$message}}</small>
							@enderror
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success">Išsaugoti</button>
						</div>
				
				</form>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
