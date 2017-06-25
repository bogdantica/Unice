@extends('layouts.app')

@section('content')

    <div class="row">

        @foreach($unice->devices as $device)
            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-2">
                @include('unices.devices.devices.' . $device->type->type_name . '.body')
            </div>
        @endforeach
    </div>

@stop
