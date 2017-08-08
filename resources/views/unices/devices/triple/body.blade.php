
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <span class="label label-{{ $device->state->state != $device->state->target ? 'warning' : 'primary' }} pull-right">{{ $device->state->state }}
            %</span>
        <h5>{{ $device->device_display }}</h5>
    </div>
    <div class="ibox-content t-a-c">

        <div class="btn-group">

            <button type="button" data-device-button="{{$device->id}}" data-state="0"
                    class="btn btn-lg btn-{{ $device->state->target == 0 ? 'primary' : 'default' }}">O</button>
            <button type="button" data-device-button="{{$device->id}}" data-state="1"
                    class="btn btn-lg btn-{{ $device->state->target == 1 ? 'primary' : 'default' }}">I</button>
            <button type="button" data-device-button="{{$device->id}}" data-state="2"
                    class="btn btn-lg btn-{{ $device->state->target == 2 ? 'primary' : 'default' }}">II
            </button>

        </div>

        <input type="hidden"
               value="{{ $device->state->state }}"
               data-device="{{$device->id}}"
               data-device-type="{{ $device->type->type_name }}"
        />

        <div device-state-history="{{$device->id}}" class="m-t-md"
             values="{{ $device->stateHistory->pluck('state')->implode(',') }}"></div>

    </div>
</div>
