<?php
class SistemaAulaFinalGradeByCourseIdParameters extends external_function_parameters{

	function SistemaAulaFinalGradeByCourseIdParameters() {

		parent::__construct(array(
			'courseId'	=> new external_value(PARAM_INT, 'ID do Curso em formato Inteiro'),
			'roleId'	=> new external_value(PARAM_INT, 'ID do Papel no curso no qual o usuário está matrículado em formato Inteiro',VALUE_DEFAULT,5)
		));
	}
}
class SistemaAulaFinalGradeByUserIdAndCourseIdParameters extends external_function_parameters{

	function SistemaAulaFinalGradeByUserIdAndCourseIdParameters() {

		parent::__construct(array(
			'userId'      => new external_value(PARAM_INT, 'Id do Usuário em formato Inteiro'),
			'courseId'    => new external_value(PARAM_INT, 'ID do Curso em formato Inteiro')
		));
	}
}