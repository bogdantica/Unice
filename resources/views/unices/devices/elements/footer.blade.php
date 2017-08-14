<input type="hidden"
       value="{{ $device->state->state }}"
       data-device="{{$device->id}}"
       data-device-type="{{ str_slug($device->type->name) }}"
/>

<div device-state-history="{{$device->id}}" class="m-t-md"
     values="{{ $device->stateHistory->pluck('state')->implode(',') }}">
</div>