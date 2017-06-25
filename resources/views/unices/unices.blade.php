{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('unice_name', 'Unice_name:') !!}
			{!! Form::text('unice_name') !!}
		</li>
		<li>
			{!! Form::label('unice_uid', 'Unice_uid:') !!}
			{!! Form::text('unice_uid') !!}
		</li>
		<li>
			{!! Form::label('online', 'Online:') !!}
			{!! Form::text('online') !!}
		</li>
		<li>
			{!! Form::label('unice_type_id', 'Unice_type_id:') !!}
			{!! Form::text('unice_type_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}