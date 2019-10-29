<?php
	return array(

		//layout

		"inicio"      => "Inicio",

		"admision" => "Admisi&oacute;n",
			"solicitante" => "Solicitante",
			"traslado" => "Traslado",

		"admin_datos" => "Administraci&oacute;n de Datos",
			"lapso"     => "Per&iacute;odo Acad&eacute;mico",
			"programas" => "Programas",
			"unidades" => "Unidades Curriculares",
			"pensum" => "Pensum",
			"autoridades" => "Autoridades",
			"condicion_estudiante" => "Estudiantes",
			"matrices" => "Equivalencia Interna",
			"movimientos" => "Movimientos",
			"constancias" => "Constancias",
			"requisitos_ins" => "Requisitos",
			"solicitantes" => "Solicitantes",
			"conceptos_adm" => "Conceptos Administrativos",
			"estatus_solvencia" => "Estatus (Solvencia)",
			'estatus' => "Estudiante",

		"procesos_acad" => "Procesos Acad&eacute;micos",
			"crear_oferta"  => "Crear Oferta",
			"ver_oferta"    => "Ver Ofertas",
			"inscripciones" => "Inscripciones",
			"nivelacion"    => "Nivelaci&oacute;n",
			"historial"    => "Historial Acad&eacute;mico",
			"solicitudes_constancias" => "Solicitudes (Constancias)",
			"transferencia" => "Transferencia de Creditos",
			"retiro" => "Retiro",
			"reincorporacion" => "Reincorporaci&oacute;n",
			"matriculacion" => "Aula Virtual",

		"procesos_admin" => "Procesos Administrativos",
		"deudas" => "Pagos del Estudiante",
		"pagos" => "Proyecci&oacute;n de Pagos",
		"solvencia" => "Solvencia",

		"asignaturas" => "Asignaturas",

		"facilitadores" => "Docentes",
			"crear_fac" => "A&ntilde;adir Docente",
			"ver_fac"   => "Ver Docentes",

		"estudiantes" => "Estudiantes",
			"crear_est" => "A&ntilde;adir Estudiante",
			"datos_est" => "Datos del Estudiante",

		"carga_academica" => "Carga Acad&eacute;mica",

		"reportes" => "Reportes",
			"estudiantes_prog" => "Estudiantes (Programas)",
			"solventes" => "Solventes",
			"resumen_carga" => "Carga (Resumen)",

		"estadisticas" => "Estad&iacute;sticas",
			"exito_acad" => "&Eacute;xito Acad&eacute;mico",
			"proyeccion_acad_siguiente" => "Proyecci&oacute;n Acad&eacute;mica (Siguiente)",
			"resumen_estadistico" => "Resumen Estad&iacute;stico",
			
		"admin" => "Administrador",
			"user"      => "Usuarios",
			"auditoria" => "Auditor&iacute;a",

		"horario" => "Horario",

		"calificaciones" => "Calificaciones",

		"cambiar_clave" => "Cambiar Clave",
		"exit" => "Salir",
		

		//MENSAJES GENERALES

		"error" => "Por favor revise los campos incorrectos",
		"activo" => "Activo",
		"anterior" => "Anterior",
		"select" => "Seleccionar...",
		"espere" => "Espere un Momento...",
		
		//CONTROLADOR: INDEX

		"index_form_ingreso" => "Ingreso al Sistema",
		"index_form_usuario" => "Usuario",
		"index_form_clave" => "Clave",
		"index_form_idim" => "{0} Seleccionar Idioma...|{1} Ingl&eacute;s|{2} Espa&ntilde;ol",
		"index_form_iniciar" => "{0} Iniciar Sesi&oacute;n como...|{1} Administrador|{2} Docente|{3} Estudiante",
		"index_form_btn" => "Ingresar",

		//CONTROLADOR: LOGIN

		//VISTA getLapso()


		"login_form_tit_lapso" => "Seleccionar Per&iacute;odo Acad&eacute;mico",
		"login_form_lapso" => "Seleccionar Per&iacute;odo...",
		"login_form_btn" => "Siguiente",

		//postLoguear()

		"incorrecto" => "Combinaci&oacute;n de clave y/o usuario incorrecta",

		//postGuardarlapso()
		"login_form_lapso_error" => "No hay registros del per&iacute;odo indicado",

		//CONTROLAR: INICIO

		"inicio_tit" => "{1} Zona del Administrador|{2} Zona del Facilitador|{3} Zona del Estudiante",
		"inicio_msg" => "Bienvenidos al Portal de Control de Estudios de FLORIDA GLOBAL UNIVERSITY",

		//CONTROLADORR: USER

		//VISTA: getCambioclave()

		"user_tit_cambio" => "Cambiar Clave",
		"user_cambio_msg" => "El sistema distingue may&uacute;sculas de min&uacute;sculas. Ingrese al menos 6 caracteres",
		"user_form_cambio_actual" => "Contrase&ntilde;a Actual",
		"user_form_cambio_nueva" => "Contrase&ntilde;a Nueva",
		"user_form_cambio_conf" => "Confirmar Contrase&ntilde;a",
		"user_form_btn" => "Actualizar",

		//postGuardarcambioclave()
		"user_msg_success" => "Clave modificada satisfactoriamente",



	);
?>
