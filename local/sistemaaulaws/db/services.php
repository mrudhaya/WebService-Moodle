<?php

$functions = array(
    'sistemaaula_grade_get_final_grade_by_user_id_and_course_id' => array(           //web service name (unique in all Moodle)
        'classname'		=> 'sistemaaula_grade_external', //class containing the function implementation
        'methodname'	=> 'get_final_grade_by_user_id_and_course_id',              //name of the function into the class
        'classpath'		=> 'local/sistemaaulaws/grade/externallib.php',     //file containing the class (only used for core external function, not needed if your file is 'component/externallib.php'),
        'description'	=> 'Retorna a grade final do aluno conforme o curso informado.',
        'capabilities'	=> 'moodle/grade:export, gradeexport/txt:view',
        'type'			=> 'read'
)
);

$services = array(
    'Sistema Aula' => array(
        'functions' => array ('sistemaaula_grade_get_final_grade_by_user_id_and_course_id'), //web service function name
        'requiredcapability' => '',                  
        'restrictedusers' => 1,
        'enabled'=>0, //used only when installing the services
)
);