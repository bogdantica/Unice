<div class="ibox float-e-margins">
    <div class="ibox-title">
        <span class="label label-{{ $device->state->state != $device->state->target ? 'warning' : 'primary' }} pull-right">{{ $device->state->state }}
            %</span>
        <h5>{{ $device->device_display }}</h5>
    </div>
    <div class="ibox-content t-a-c">

        <input type="text"
               value="{{ $device->state->target }}"
               data-device="{{$device->id}}"
               data-device-type="{{ $device->type->type_name }}"
        />

        <div device-state-history="{{$device->id}}"
             values="{{ $device->stateHistory->pluck('state')->implode(',') }}"></div>

    </div>
</div>


{{--<div class="ibox t-a-c">--}}
{{--<div class="ibox-content">--}}
{{--<h5 class="m-b-md">{{ $device->device_display }}</h5>--}}

{{--<h4>--}}
{{--<input type="text"--}}
{{--value="{{ $device->state->target }}"--}}
{{--data-device="{{$device->id}}"--}}
{{--data-device-type="{{ $device->type->type_name }}"--}}
{{--/>--}}
{{--</h4>--}}
{{--</div>--}}
{{--</div>--}}