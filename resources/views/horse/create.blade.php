@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Add new horse</div>
               <div class="card-body">
                <form method="POST" action="{{route('horse.store')}}">
                <div class="form-group">
                        <label>Name: </label>
                        <input type="text" class="form-control" name="horse_name" value="{{old('horse_name')}}">
                        <small class="form-text text-muted">Please enter horse name.</small>
                    </div>
                    <div class="form-group">
                        <label>Runs : </label>
                        <input type="text" class="form-control" name="horse_runs"  value="{{old('horse_runs')}}">
                        <small class="form-text text-muted">Please enter horse run.</small>
                    </div>
                    <div class="form-group">
                        <label>Wins : </label>
                        <input type="text" class="form-control" name="horse_wins"  value="{{old('horse_wins')}}">
                        <small class="form-text text-muted">Please enter horse wins.</small>
                    </div>
                    <div class="form-group">
                        <label>About </label>
                        <textarea name="horse_about" value="{{old('horse_about')}}" id="summernote"> </textarea>
                        <small class="form-text text-muted">About this horse.</small>
                    </div>
                    @csrf
                    <button class="btn btn-primary" type="submit">ADD</button>
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
