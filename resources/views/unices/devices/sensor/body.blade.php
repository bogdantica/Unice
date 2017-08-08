<div class="ibox float-e-margins">
    <div class="ibox-title">
        <span class="label label-success pull-right">{{ $device->state->state }} &#8451;</span>
        <h4>{{ $device->device_display }}</h4>
    </div>
    <div class="ibox-content t-a-c">

        <div data-device="{{ $device->id }}" data-device-type="{{ $device->type->type_name }}"
             values="{{ $device->stateHistory->pluck('state')->implode(',') }}"></div>

    </div>
</div>


{{--<div class="ibox t-a-c">--}}
{{--<div class="ibox-content">--}}
{{--<h5 class="m-b-md">{{ $device->device_display }}</h5>--}}
{{--<h4>--}}
{{--{{ $device->state->state }} &#8451;--}}

{{--<div data-device="{{ $device->id }}" data-device-type="{{ $device->type->type_name }}"--}}
{{--values="{{ $device->stateHistory->pluck('state')->implode(',') }}"></div>--}}
{{--</h4>--}}
{{--</div>--}}
{{--</div>--}}