<div id="actions-device-{{ $device->id }}" class="hide">

    @if($device->state->state_target_real)
        <h2 class="text-danger">
            <a href="{{ route('unice.device.update-state',['device' => $device->id,'state' => 0]) }}">
                <i class="fa fa-stop"></i> Turn Off
            </a>
        </h2>
    @else
        <h2 class="text-success">
            <a href="{{ route('unice.device.update-state',['device' => $device->id,'state' => 1]) }}">
                <i class="fa fa-stop"></i> Turn On
            </a>
        </h2>
    @endif
</div>
