<?php

return array(
	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/
	"success"		   => "Success",
	"error"		  	   => "Error",
	"warning"		   => "Warning",
	"info"			   => "Info",
	"checkFormError"   => "Please check the form below for errors",
	"accepted"         => "The must be accepted.",
	"active_url"       => "The is not a valid URL.",
	"after"            => "The must be a date after :date.",
	"alpha"            => "The may only contain letters.",
	"alpha_dash"       => "The may only contain letters, numbers, and dashes.",
	"alpha_num"        => "The may only contain letters and numbers.",
	"before"           => "The must be a date before :date.",
	"between"          => array(
		"numeric" => "The must be between :min - :max.",
		"file"    => "The must be between :min - :max kilobytes.",
		"string"  => "The must be between :min - :max characters.",
	),
	"confirmed"        => "The confirmation does not match.",
	"date"             => "The is not a valid date.",
	"date_format"      => "The does not match the format :format.",
	"different"        => "The and :other must be different.",
	"digits"           => "The must be :digits digits.",
	"digits_between"   => "The must be between :min and :max digits.",
	"email"            => "The format is invalid.",
	"exists"           => "The selected is invalid.",
	"image"            => "The must be an image.",
	"in"               => "The selected is invalid.",
	"integer"          => "The must be an integer.",
	"ip"               => "The must be a valid IP address.",
	"max"              => array(
		"numeric" => "The may not be greater than :max.",
		"file"    => "The may not be greater than :max kilobytes.",
		"string"  => "The may not be greater than :max characters.",
	),
	"mimes"            => "The must be a file of type: :values.",
	"min"              => array(
		"numeric" => "The must be at least :min.",
		"file"    => "The must be at least :min kilobytes.",
		"string"  => "The must be at least :min characters.",
	),
	"not_in"           => "The selected is invalid.",
	"numeric"          => "The must be a number.",
	"regex"            => "The format is invalid.",
	"required"         => "The field is required.",
	"required_if"      => "The field is required when :other is :value.",
	"required_with"    => "The field is required when :values is present.",
	"required_without" => "The field is required when :values is not present.",
	"same"             => "The and :other must match.",
	"size"             => array(
		"numeric" => "The must be :size.",
		"file"    => "The must be :size kilobytes.",
		"string"  => "The must be :size characters.",
	),
	"unique"           => "The has already been taken.",
	"url"              => "The format is invalid.",

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
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
