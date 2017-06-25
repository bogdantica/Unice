@extends('layouts.app')

@section('content')

    <div class="row">
        @foreach($unices as $unice)

            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                <div class="contact-box center-version">
                    <a href="{{ route('unice.unice',$unice->id) }}">
                        <h3 class="m-b-xs"><strong>{{ $unice->unice_display }}</strong></h3>
                        <div class="font-bold">{{ $unice->type->type_display }}</div>
                        <div class="m-t-xs">
                            <span class="label label-primary">Active</span>
                        </div>

                        @if($unice->last_sync)
                            <div class="m-t-sm">
                                Last Sync {{ $unice->last_sync->diffforhumans() }}
                            </div>
                        @endif

                        @if($unice->last_reported)
                            <div class="m-t-sm">
                                Last
                                Report {{ $unice->last_reported }}
                            </div>
                        @endif

                    </a>

                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            <a class="btn btn-xs btn-white"><i class="fa fa-eye"></i>
                                Quick View
                            </a>
                            <span class="btn btn-xs btn-white">
                                {{ $unice->devices_count }} Devices
                                <i class="fa fa-microchip" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>

@stop