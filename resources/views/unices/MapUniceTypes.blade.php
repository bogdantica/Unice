{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('unice_type_id', 'Unice_type_id:') !!}
			{!! Form::text('unice_type_id') !!}
		</li>
		<li>
			{!! Form::label('type_name', 'Type_name:') !!}
			{!! Form::text('type_name') !!}
		</li>
		<li>
			{!! Form::label('type_display', 'Type_display:') !!}
			{!! Form::text('type_display') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}