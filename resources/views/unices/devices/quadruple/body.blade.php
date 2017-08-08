<div class="ibox t-a-c">
    <div class="ibox-content">
        <h5 class="m-b-md">{{ $device->device_display }}</h5>

        <h4>

            <button type="button" data-device-button="{{$device->id}}" data-state="0"
                    class="btn btn-{{ $device->state->target == 0 ? 'primary' : 'default' }}">O
            </button>
            <button type="button" data-device-button="{{$device->id}}" data-state="1"
                    class="btn btn-{{ $device->state->target == 1 ? 'primary' : 'default' }}">I
            </button>
            <button type="button" data-device-button="{{$device->id}}" data-state="2"
                    class="btn btn-{{ $device->state->target == 2 ? 'primary' : 'default' }}">I
            </button>
            <button type="button" data-device-button="{{$device->id}}" data-state="3"
                    class="btn btn-{{ $device->state->target == 3 ? 'primary' : 'default' }}">I
            </button>


            <input type="hidden"
                   value="{{ $device->state->state }}"
                   data-device="{{$device->id}}"
                   data-device-type="{{ $device->type->type_name }}"
            />

            <div device-state-history="{{$device->id}}"
                 values="{{ $device->stateHistory->pluck('state')->implode(',') }}"></div>

        </h4>
    </div>
</div>
