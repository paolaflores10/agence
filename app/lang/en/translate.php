<?php
	return array(

		//layout

		"inicio"      => "Home",

		"admision" => "Admission",
			"solicitante" => "Applicant",
			"traslado" => "Transfer",

		"admin_datos" => "Data Management",
			"lapso"     => "Academic Period",
			"programas" => "Programs",
			"unidades" => "Curricular Units",
			"pensum" => "Pensum",
			"autoridades" => "Authorities",
			"condicion_estudiante" => "Students",
			"matrices" => "Internal Equivalence",
			"movimientos" => "Movements",
			"constancias" => "Constancy",
			"requisitos_ins" => "Requirements",
			"solicitantes" => "Applicants",
			"conceptos_adm" => "Administrative Concepts",
			"estatus_solvencia" => "Status (Solvency)",
			'estatus' => "Estudent",

		"procesos_acad" => "Academic Processes",
			"crear_oferta"  => "Create Offer",
			"ver_oferta"    => "All Offers",
			"inscripciones" => "Inscriptions",
			"nivelacion"    => "Leveling",
			"historial"    => "Academic Historial",
			"solicitudes_constancias" => "Request (Constancy)",
			"transferencia" => "Credit Transfer",
			"retiro" => "Retirement",
			"reincorporacion" => "Reincorporation",
			"matriculacion" => "Virtual Classroom",

		"procesos_admin" => "Administrative Processes",
		"deudas" => "Student Payments",
		"pagos" => "Payment Projection",
		"solvencia" => "Solvency",

		"asignaturas" => "Subjects",

		"facilitadores" => "Teachers",
			"crear_fac" => "Add",
			"ver_fac"   => "All Teachers",

		"estudiantes" => "Students",
			"crear_est" => "Add",
			"datos_est" => "Student Data",

		"carga_academica" => "Academic Load",

		"reportes" => "Reports",
			"estudiantes_prog" => "Students (Programs)",
			"solventes" => "Solvents",
			"resumen_carga" => "Academic Load (Summary)",
		"estadisticas" => "Statistics",
			"exito_acad" => "Academic Success",
			"proyeccion_acad_siguiente" => "Academic Projection (Incoming)",
			"resumen_estadistico" => "Statistical Summary",
			
		"admin" => "Admin",
			"user"      => "Users",
			"auditoria" => "Audit",

		"horario" => "Schedule",

		"calificaciones" => "Qualifications",

		"cambiar_clave" => "Change Password",
		"exit" => "Exit",


		//MENSAJES GENERALES

		"error" => "Please check the incorrect fields",
		"activo" => "Active",
		"anterior" => "Previous",
		"select" => "Select...",
		"espere" => "Wait a Moment...",
		
		//CONTROLADOR: INDEX

		"index_form_ingreso" => "Login",
		"index_form_usuario" => "User",
		"index_form_clave" => "Password",
		"index_form_idim" => "{0} Language...|{1} English|{2} Spanish",
		"index_form_iniciar" => "{0} Sign in as...|{1} Administrator|{2} Teacher|{3} Student",
		"index_form_btn" => "Enter",

		//CONTROLADOR: LOGIN

		//VISTA getLapso()

		"login_form_tit_lapso" => "Indicate the Academic Period",
		"login_form_lapso" => "Academic Period...",
		"login_form_btn" => "Next",

		//postLoguear()

		"incorrecto" => "Incorrect key and/or user combination",

		//postGuardarlapso()
		"login_form_lapso_error" => "No records",

		//CONTROLADORR: INICIO

		"inicio_tit" => "{1} Admin Area|{2} Teacher Area|{3} Student Area",
		"inicio_msg" => "Welcome to the FLORIDA GLOBAL UNIVERSITY Study Control Portal",

		//CONTROLADORR: USER

		//VISTA: getCambioclave()

		"user_tit_cambio" => "Change Password",
		"user_cambio_msg" => "The system is case sensitive. Enter at least 6 characters",
		"user_form_cambio_actual" => "Current Password",
		"user_form_cambio_nueva" => "New Password",
		"user_form_cambio_conf" => "Confirm Password",
		"user_form_btn" => "Update",

		//postGuardarcambioclave()
		"user_msg_success" => "Password Successfully Changed",
	);
?>
