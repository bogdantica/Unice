<div class="ibox float-e-margins">
    @include('unices.devices.elements.header')
    <div class="ibox-content t-a-c">

        @include('unices.devices.elements.footer')
        {{--<input type="text"--}}
        {{--value="{{ $device->state->target }}"--}}
        {{--data-device="{{$device->id}}"--}}
        {{--data-device-type="{{ $device->type->type_name }}"--}}
        {{--/>--}}

        {{--<div device-state-history="{{$device->id}}"--}}
        {{--values="{{ $device->stateHistory->pluck('state')->implode(',') }}"></div>--}}

    </div>
</div>