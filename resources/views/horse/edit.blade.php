@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit horse</div>
               <div class="card-body">
                <form method="POST" action="{{route('horse.update',[$horse])}}">
                <div class="form-group">
                        <label>Name: </label>
                        <input type="text" class="form-control" name="horse_name" value="{{$horse->name}}" value="{{old('horse_name',$horse->name)}}">
                        <small class="form-text text-muted">Edit horse name.</small>
                    </div>
                    <div class="form-group">
                        <label>Runs : </label>
                        <input type="text" class="form-control" name="horse_runs" value="{{$horse->runs}}"  value="{{old('horse_runs',$horse->runs)}}">
                        <small class="form-text text-muted">Edit horse run.</small>
                    </div>
                    <div class="form-group">
                        <label>Wins : </label>
                        <input type="text" class="form-control" name="horse_wins"  value="{{$horse->wins}}" value="{{old('horse_wins',$horse->wins)}}">
                        <small class="form-text text-muted">Edit horse wins.</small>
                    </div>
                    <div class="form-group">
                        <label>About </label>
                        <textarea name="horse_about"  id="summernote"> {{($horse->about)}}</textarea>
                        <small class="form-text text-muted">About this horse.</small>
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