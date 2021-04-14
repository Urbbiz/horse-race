@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <h2>Betters List</h2>
                    <div class="make-inline">
                        <form action="{{route('better.index')}}" method="get" class="make-inline ">
                            <div class="form-group make-inline">
                                <label>Horses: </label>
                                <select class="form-control" name="horse_id">
                                    <option value="0" disabled @if($filterBy==0) selected @endif>Select horse</option>
                                    @foreach ($horses as $horse)
                                    <option value="{{$horse->id}}" @if($filterBy==$horse->id) selected @endif>
                                        {{$horse->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group make-inline column">
                                <label class="form-check label" for="sortASC">sort ASC</label>
                                <input type="radio" class="form-check-input" name="sort" value="asc" id="sortASC" @if($sortBy=='asc' ) checked @endif>
                            </div>
                            <div class="form-group make-inline column">
                                <label class="form-check label" for="sortDESC">sort DESC</label>
                                <input type="radio" class="form-check-input" name="sort" value="desc" id="sortDESC" @if($sortBy=='desc' ) checked @endif>
                            </div>

                            <button type="submit" class="btn btn-info">Filter</button>
                        </form>

                        <a href="{{route('better.index')}}" class="btn btn-info">Clear filter</a>
                    </div>




                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($betters  as $better) 
                        {{-- @foreach ($betters = $betters ->sortBy('surname') as $better) (sita dedam, vietoj virsutinio, jeigu iskrt norim sortint) --}}
                        <li class="list-group-item list-line">
                            <div class="list-line__books">
                                <div class="list-line__books__title">
                                   <h4> {{$better->name}}, {{$better->surname}} </h4>
                                   <h6> Bet: {{$better->bet}} EUR </h6>
                                </div>
                                <div class="list-line__books__author">
                                   Horse  {{$better->betterHorses->name}} 
                                </div>
                            </div>
                            <div class="list-line__buttons">
                                <a href="{{route('better.edit',[$better])}}" class="btn btn-info">EDIT</a>
                                <form method="POST" action="{{route('better.destroy', [$better])}}">
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

