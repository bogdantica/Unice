{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('device_id', 'Device_id:') !!}
			{!! Form::text('device_id') !!}
		</li>
		<li>
			{!! Form::label('state_current', 'State_current:') !!}
			{!! Form::text('state_current') !!}
		</li>
		<li>
			{!! Form::label('state_target', 'State_target:') !!}
			{!! Form::text('state_target') !!}
		</li>
		<li>
			{!! Form::label('state_target_real', 'State_target_real:') !!}
			{!! Form::text('state_target_real') !!}
		</li>
		<li>
			{!! Form::label('last_time_state_sended', 'Last_time_state_sended:') !!}
			{!! Form::text('last_time_state_sended') !!}
		</li>
		<li>
			{!! Form::label('last_time_state_reported', 'Last_time_state_reported:') !!}
			{!! Form::text('last_time_state_reported') !!}
		</li>
		<li>
			{!! Form::label('manual_control', 'Manual_control:') !!}
			{!! Form::text('manual_control') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}