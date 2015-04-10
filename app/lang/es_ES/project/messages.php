<?php

return array(


	'createVolunteer'=> array(
			'error'   		=> 'El poyecto de voluntariado no se ha podido crear.',
			'success' 		=> 'El poyecto de voluntariado se ha creado con exito.',
			'errorBanned' 	=> 'Su cuenta se encuentra baneada, no puede crear proyectos.',
			'errorNotActive'=> 'Su cuenta aún no está verificada por el administrador, no pude crear proyectos.'
	),
	'editVolunteer'=> array(
		'error'   		=> 'El poyecto de voluntariado no se ha podido modificar.',
		'success' 		=> 'El poyecto de voluntariado se ha modificado con exito.',
		'errorBanned' 	=> 'Su cuenta se encuentra baneada, no puede editar proyectos.',
		'errorNotActive'=> 'Su cuenta aún no está verificada por el administrador, no pude editar proyectos.',
		'errorNotHisProject'=> 'Sólo puede editar sus proyectos.',
		'errorWithVolunteer'    => 'No se pueden editar proyectos con voluntarios ya añadidos.',
        'errorWithApplications'    => 'No se pueden editar proyectos con solicitudes de voluntariado pendientes.'

	),
	'deleteVolunteer'=> array(
		'error'   				=> 'El poyecto de voluntariado no se ha podido eliminar.',
		'success' 				=> 'El poyecto de voluntariado se ha eliminado con exito.',
		'errorBanned' 	        => 'Su cuenta se encuentra baneada, no puede eliminar proyectos.',
		'errorNotActive'        => 'Su cuenta aún no está verificada por el administrador, no pude eliminar proyectos.',
		'errorNotHisProject'    => 'Sólo puede eliminar sus proyectos.',
		'errorWithVolunteer'    => 'No se pueden eliminar proyectos con voluntarios ya añadidos.',
		'errorWithApplications' => 'No se pueden eliminar proyectos con solicitudes de voluntariado pendientes.'

	)

);
