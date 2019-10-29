<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "The field must be accepted.",
	"active_url"           => "The field is not a valid URL.",
	"after"                => "The field must be a date after.",
	"alpha"                => "The field may only contain letters.",
	"alpha_dash"           => "The field may only contain letters, numbers, and dashes.",
	"alpha_num"            => "The field may only contain letters and numbers.",
	"array"                => "The field must be an array.",
	"before"               => "The field must be a date before :date.",
	"between"              => array(
		"numeric" => "The field must be between :min and :max.",
		"file"    => "The field must be between :min and :max kilobytes.",
		"string"  => "The field must be between :min and :max characters.",
		"array"   => "The field must have between :min and :max items.",
	),
	"confirmed"            => "The field confirmation does not match.",
	"date"                 => "The field is not a valid date.",
	"date_format"          => "The field does not match the format :format.",
	"different"            => "The field and :other must be different.",
	"digits"               => "The field must be :digits digits.",
	"digits_between"       => "The field must be between :min and :max digits.",
	"email"                => "The field must be a valid email address.",
	"exists"               => "The selected field is invalid.",
	"image"                => "The field must be an image.",
	"in"                   => "The selected field is invalid.",
	"integer"              => "The field must be an integer.",
	"ip"                   => "The field must be a valid IP address.",
	"max"                  => array(
		"numeric" => "The field may not be greater than :max.",
		"file"    => "The field may not be greater than :max kilobytes.",
		"string"  => "The field may not be greater than :max characters.",
		"array"   => "The field may not have more than :max items.",
	),
	"mimes"                => "The field must be a file of type: :values.",
	"min"                  => array(
		"numeric" => "The field must be at least :min.",
		"file"    => "The field must be at least :min kilobytes.",
		"string"  => "The field must be at least :min characters.",
		"array"   => "The field must have at least :min items.",
	),
	"not_in"               => "The selected field is invalid.",
	"numeric"              => "The field must be a number.",
	"regex"                => "The field format is invalid.",
	"required"             => "The field is required.",
	"required_if"          => "The field is required when :other is :value.",
	"required_with"        => "The field is required when :values is present.",
	"required_with_all"    => "The field is required when :values is present.",
	"required_without"     => "The field is required when :values is not present.",
	"required_without_all" => "The field is required when none of :values are present.",
	"same"                 => "The field must match the previous one.",
	"size"                 => array(
		"numeric" => "The field must be :size.",
		"file"    => "The field must be :size kilobytes.",
		"string"  => "The field must be :size characters.",
		"array"   => "The field must contain :size items.",
	),
	"unique"               => "The field has already been taken.",
	"url"                  => "The field format is invalid.",

	//Validaciones Personalizadas
	"mayor_cero" => "There is no record in the DB with those parameters",

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

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
	),

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
