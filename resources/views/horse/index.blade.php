{{-- @foreach ($horses as $horse)
  {{$horse->name}} {{$horse->surname}}<br>
@endforeach



 --}}

@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
          <div class="card">
            <div class="card-header">
               <h2>Horse List</h2>
               <a href="{{route('horse.index',['sort'=>'name'])}}">Sort by Name</a>
               <a href="{{route('horse.index',['sort'=>'wins'])}}">Sort by Wins</a>
               <a href="{{route('horse.index')}}">Default</a>
            </div>
               <div class="card-body">
                <ul class="list-group">

                  @foreach ( $horses as $horse) 
                  {{-- @foreach ( $horses = $horses ->sortBy('area') as $horse) "toki darom, jeigu default reikia pagal kazka rusiuoti" --}}
                    <li class="list-group-item list-line">
                      <div>
                        <h4>{{$horse->name}}</h4>
                        <h6> Runs: {{$horse->runs}} </h6>
                        <h6> Wins: {{$horse->wins}} </h6>
                        <h6> About horse: {{$horse->about}} </h6>
                      </div> 
                      <div class="list-line__buttons">
                        <a href="{{route('horse.edit',[$horse])}}" class="btn btn-info">EDIT</a>
                        <form method="POST" action="{{route('horse.destroy', [$horse])}}">
                        @csrf
                        <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                      </div>
                    </li>
                    @endforeach
                </ul>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
