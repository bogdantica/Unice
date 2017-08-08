@extends('layouts.app')

@section('content')

    <div class="row">

        @foreach($unice->devices as $device)
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                @includeIf('unices.devices.' . $device->type->type_name . '.body')
            </div>
        @endforeach
    </div>

@stop
