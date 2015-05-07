<?php

return array(
	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| El following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/
	"success"		   => "Éxito",
	"error"		  	   => "Error",
	"warning"		   => "Cuidado",
	"info"			   => "Información",
	"checkFormError"   => "Por favor, comprueba los errores del formulario",
	"accepted"         => "El campo debe ser aceptado.",
	"active_url"       => "El campo no es una URL válida.",
	"after"            => "El campo debe ser una fecha posterior a :date.",
	"alpha"            => "El campo sólo puede contener letras.",
	"alpha_dash"       => "El campo sólo puede contener letras, números y guiones.",
	"alpha_num"        => "El campo sólo puede contener letras y números.",
	"before"           => "El campo debe ser una fecha anterior a :date.",
	"between"          => array(
		"numeric" => "El campo debe estar comprendido entre :min - :max.",
		"file"    => "El campo debe tener entre :min - :max kilobytes.",
		"string"  => "El campo debe tener entre :min - :max characters.",
	),
	"confirmed"        => "El campo confirmación no coincide.",
	"date"             => "El campo no es una fecha válida.",
	"date_format"      => "El campo no coincide con el formato :format.",
	"different"        => "El campo y :other deben ser diferentes.",
	"digits"           => "El campo debe tener :digits dígitos.",
	"digits_between"   => "El campo debe tener entre :min and :max digits.",
	"email"            => "El campo formato no es válido.",
	"exists"           => "El campo seleccionado es inválido.",
	"image"            => "El campo debe ser una imágen.",
	"in"               => "El campo seleccionado es inválido..",
	"integer"          => "El campo debe ser un entero.",
	"ip"               => "El campo debe ser una dirección IP válida.",
	"max"              => array(
		"numeric" => "El campo no debe ser mayor a :max.",
		"file"    => "El campo no debe ser mayor a :max kilobytes.",
		"string"  => "El campo no debe ser mayor a :max characters.",
	),
	"mimes"            => "El campo debe ser un archivo de tipo :values.",
	"min"              => array(
		"numeric" => "El campo debe ser mínimo de :min.",
		"file"    => "El campo debe tener al menos :min kilobytes.",
		"string"  => "El campo debe tener al menos :min characters.",
	),
	"not_in"           => "El campo es inválido.",
	"numeric"          => "El campo debe ser numérico.",
	"regex"            => "El formato del campo es inválido.",
	"required"         => "El campo es requerido.",
	"required_if"      => "El campo es requerido cuando :other es :value.",
	"required_with"    => "El campo es requerido cuando :values está presente.",
	"required_without" => "El campo es requerido cuando :values no está presente.",
	"same"             => "El campo y :other no coinciden.",
	"size"             => array(
		"numeric" => "El campo debe ser :size.",
		"file"    => "El campo debe ser de :size kilobytes.",
		"string"  => "El campo debe ser de :size caracteres.",
	),
	"unique"           => "El campo ya ha sido tomado.",
	"url"              => "El formato del campo es inválido.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/
	
	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| El following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
