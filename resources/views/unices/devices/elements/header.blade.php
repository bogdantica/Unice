<div class="ibox-title">
        <span class="label label-{{ $device->state->state != $device->state->target ? 'warning' : 'primary' }} pull-right">{{ $device->state->state }}
            %</span>
    <h5>{{ $device->name }}</h5>
</div>