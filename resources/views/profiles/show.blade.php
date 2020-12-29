
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($activities as $date =>$activity)
                <h2>{{$date}}</h2>
                @foreach ($activity as $record)
                    @include("profiles.activities.{$record->type}", ['activity'  =>  $record])
                @endforeach

            @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
