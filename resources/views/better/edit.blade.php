@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit Better</div>
               <div class="card-body">
                 <form method="POST" action="{{route('better.update',[$better])}}">
               
                    <div class="form-group">
                        <label>Name: </label>
                        <input type="text" class="form-control" name="better_name" value="{{old('better_name', $better->name)}}">
                        <small class="form-text text-muted">Edit better name.</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Surname: </label>
                        <input type="text" class="form-control" name="better_surname" value="{{old('better_surname', $better->surname)}}" >
                        <small class="form-text text-muted">Edit better surname.</small>
                    </div>

                    <div class="form-group">
                        <label>Bet: </label>
                        <input type="text" class="form-control" name="better_bet" value="{{old('better_bet', $better->bet)}}" >
                        <small class="form-text text-muted">Edit bet count.</small>
                    </div>


                     <div class="form-group">
                        <label>Horses: </label>
                        <select name="horse_id">
                            @foreach ($horses as $horse)
                                <option value="{{$horse->id}}"@if($horse->id == $better->horse_id) selected @endif>
                                {{old('horse_name',$horse->name)}}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Edit horse.</small>
                    </div>

                    @csrf
                    <button class="btn btn-primary" type="submit">EDIT</button>
                    </form>

               </div>
           </div>
       </div>
   </div>
</div>

<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>

@endsection