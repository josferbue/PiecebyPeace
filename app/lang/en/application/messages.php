<?php

return array(

    'create' => array(
        'error'                     => 'The application could not be sent. Please, try it again.',
        'success'                   => 'The application has been successfully sent.',
        'errorNotIsVolunteer'       => 'Only volunteers can apply for projects.',
        'errorNotVolunteerPlaces'   => 'The maximum number of cooperators has already been reached.',
        'errorIsCooperateYet'       => 'You are already cooperating in this project.',
        'errorIsApplyYet'           => 'You have already applied for this project.',
        'errorFinishProject'        => 'This project has finished.',
        'errorOverlapsDates'        => 'The dates of this project overlap with the ones from your other projects.',
    ),
    'cancel' => array(
        'errorIsAnswered'           => 'Answered applications can not be deleted.',
        'error'                     => 'An error took place while deleting the application. Please, try it again.',
        'success'                   => 'The application has been successfully deleted.',
        'errorNotYourApplication'    => 'You can only delete your applications.',


    ),
    'answer' => array(
        'error'                     => 'The answer for this application was not sent. Please, try it again.',
        'success'                   => 'The application has been succesfully answered.',
        'errorNotHisProject'        => 'You can only answer applications involved in your projects.',
        'errorAnsweredYet'          => 'The application has been already answered.',
        'errorRequest'              => 'An error took place due to the URL was manipulated.',
    ),
    'view' => array(
        'errorNotYourApplication'   => 'You can only view your applications.',

    ),
);
