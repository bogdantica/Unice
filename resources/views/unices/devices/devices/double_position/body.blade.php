<div class="ibox t-a-c">
    <div class="ibox-content">
        <h5 class="m-b-md">{{ $device->device_display }}</h5>

        <h4>
            <input type="checkbox" class="js-switch" {{ $device->state->state_target_real ? 'checked' : '' }}
            data-plugin="device-action"
            data-device="{{$device->id}}"
                   data-device-type="{{ $device->type->device_type_id }}"
            />
        </h4>

        @if($device->state->last_time_target_updated)
            <small>Since {{ $device->state->last_time_target_updated->diffforhumans() }}</small>
        @endif

    </div>
</div>

@push('extra')
@includeIf('unices.devices.devices.'.$device->type->type_name.'.actions')
@endpush