<div class="ibox t-a-c">
    <div class="ibox-content">
        <h5 class="m-b-md">{{ $device->device_display }}</h5>

        <h4>
            <input type="checkbox" class="js-switch" {{ $device->state->target ? 'checked' : '' }}
            data-plugin="device-action"
                   data-device="{{$device->id}}"
            />
        </h4>
    </div>
</div>

@push('extra')
    @includeIf('unices.devices.devices.'.$device->type->type_name.'.actions')
@endpush