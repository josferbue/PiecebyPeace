<?php

return array(

    'create' => array(
        'error'                     => 'La solicitud no pudo enviarse.',
        'success'                   => 'La solicitud se ha enviado correctamente.',
        'errorNotIsVolunteer'       => 'Sólo los voluntarios pueden solicitar plazas.',
        'errorNotVolunteerPlaces'   => 'No quedan plazas disponibles.',
        'errorIsCooperateYet'       => 'Ya colabora en este proyecto.',
        'errorIsApplyYet'           => 'Ya ha enviado una solicitud para este proyecto.',
        'errorFinishProject'        => 'El proyecto ya ha finalizado.',
        'errorOverlapsDates'        => 'Actualmente se encuentra colaborando en proyectos que coinciden con las fechas de este.',
    ),
    'cancel' => array(
        'errorIsAnswered'           => 'No puedes eliminar solicitudes ya contestadas.',
        'success'                   => 'La solicitud se borró correctamente.',
        'error'                     => 'No se puedo eliminar la solicitud, inténtelo de nuevo.',
        'errorNotYourApplication'    => 'No puede elimnar solicitudes que no le pertenecen.',


    ) ,
    'answer' => array(
        'error'                     => 'La solicitud no ha podido ser contestada, inténtelo de nuevo.',
        'success'                   => 'La solicitud ha sido contestada correctamente.',
        'errorNotHisProject'        => 'Sólo pueden responderse solicitudes sobre sus proyectos.',
        'errorAnsweredYet'          => 'La solicitud ya fue respondida anteriormente.',
        'errorRequest'              => 'Se ha producido un error al intentar manipular la URL de la petición.',
),
    'view' => array(
        'errorNotYourApplication'   => 'Esa solicitud no le pertenece.',
    ),

);
