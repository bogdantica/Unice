
<div class="ibox float-e-margins">
    @include('unices.devices.elements.header')
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

       @include('unices.devices.elements.footer')

    </div>
</div>
