<?php

$functions = array(
    'sistemaaula_grade_get_final_grade_by_user_id_and_course_id' => array(           //web service name (unique in all Moodle)
        'classname'		=> 'sistemaaula_grade_external', //class containing the function implementation
        'methodname'	=> 'get_final_grade_by_user_id_and_course_id',              //name of the function into the class
        'classpath'		=> 'local/sistemaaulaws/grade/externallib.php',     //file containing the class (only used for core external function, not needed if your file is 'component/externallib.php'),
        'description'	=> 'Retorna a grade final do aluno conforme o curso informado.',
        'capabilities'	=> 'moodle/grade:export, gradeexport/txt:view',
        'type'			=> 'read'
),
	'sistemaaula_grade_get_final_grade_by_course_id' => array(           //web service name (unique in all Moodle)
        'classname'		=> 'sistemaaula_grade_external', //class containing the function implementation
        'methodname'	=> 'get_final_grade_by_course_id',              //name of the function into the class
        'classpath'		=> 'local/sistemaaulaws/grade/externallib.php',     //file containing the class (only used for core external function, not needed if your file is 'component/externallib.php'),
        'description'	=> 'Retorna a grade final dos aluno conforme o curso informado.',
        'capabilities'	=> 'moodle/grade:export, gradeexport/txt:view',
        'type'			=> 'read'
),
	'sistemaaula_user_create_users' => array(
		'classname'		=> 'sistemaaula_user_external', 
        'methodname'	=> 'create_users',
        'classpath'		=> 'local/sistemaaulaws/user/externallib.php', 
        'description'	=> 'Classe identica á moodle_user_create_users, porem as execptions foram mudadas para dar um retorno mais claro. Esta classe cria um ou mais usuários no MOODLE',
        'capabilities'	=> 'moodle/user:create',
        'type'			=> 'write'

)
);

$services = array(
    'Sistema Aula' => array(
        'functions' => array ('sistemaaula_grade_get_final_grade_by_user_id_and_course_id','sistemaaula_grade_get_final_grade_by_course_id','sistemaaula_user_create_users'), //web service function name
        'requiredcapability' => '',                  
        'restrictedusers' => 1,
        'enabled'=>1, //used only when installing the services
	)
);