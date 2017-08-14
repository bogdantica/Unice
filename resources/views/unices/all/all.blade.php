@extends('layouts.app')

@section('content')

    <div class="row">
        @foreach($unices as $unice)

            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                <div class="contact-box center-version">
                    <a href="{{ route('unice.unice',$unice->id) }}">
                        <h3 class="m-b-xs"><strong>{{ $unice->name }}</strong></h3>
                        <div class="m-t-xs">
                            <span class="label label-primary">Active</span>
                        </div>
                    </a>

                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            <span class="btn btn-xs btn-white">
                                <i class="fa fa-microchip" aria-hidden="true"></i>
                                {{ $unice->devices_count }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>

@stop