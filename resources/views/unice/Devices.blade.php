{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('device_name', 'Device_name:') !!}
			{!! Form::text('device_name') !!}
		</li>
		<li>
			{!! Form::label('device_uid', 'Device_uid:') !!}
			{!! Form::text('device_uid') !!}
		</li>
		<li>
			{!! Form::label('unice_id', 'Unice_id:') !!}
			{!! Form::text('unice_id') !!}
		</li>
		<li>
			{!! Form::label('device_type_id', 'Device_type_id:') !!}
			{!! Form::text('device_type_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}