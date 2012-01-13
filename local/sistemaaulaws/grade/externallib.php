<?php

// This file is part of Moodle - http://moodle.org/ and SAWEE (www.sistemaaula.com.br)
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * External user API
 *
 * @package    sistemaaula
 * @subpackage moodlewebservice.grade
 * @copyright  Sistema Aula - (http://sistemaaula.github.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/externallib.php");
require("returnlib.php");
require("parameterlib.php");

class sistemaaula_grade_external extends external_api {

	public static function get_final_grade_by_user_id_and_course_id_parameters() {
		return new SistemaAulaFinalGradeByUserIdAndCourseIdParameters();
	}

	/**
	 * Returns description of method result value
	 * @return external_description
	 */
	public static function get_final_grade_by_user_id_and_course_id_returns() {
		return new SistemaAulaGradeReturn();
	}

	/**
	 * Retorna a nota do aluno em um curso informado.
	 *
	 * Significado dos valores negativos:
	 * -1 Nota não informada
	 * -9999 a grade não existe
	 * -8888 a grade retornou null
	 *
	 * @param int $userid
	 * @param int $courseid
	 * @return int Nota do aluno no curso.
	 */
	public static function get_final_grade_by_user_id_and_course_id($userid,$courseid) {
		// no MOODLE não temos factories
		// obtemos os acessores diretamente via variaveis globais
		global $CFG;

		require_once($CFG->dirroot.'/grade/lib.php');
		require_once($CFG->dirroot.'/grade/querylib.php');
		require_once($CFG->dirroot . "/user/lib.php");

		// para trabalhar com as grades de notas precisa-se ter
		// as seguintes habilidades:
		// * moodle/grade:export
		// * gradeexprt/txt:view
		// primeiro pego o contexto do sistema com base no usuário corrente
		$context = get_context_instance(CONTEXT_SYSTEM);
		// então verifico as abilidades uma a uma
		require_capability('moodle/grade:export', $context);
		require_capability('gradeexport/txt:view', $context);

		// neste ponto se verifica os parametros informados estão corretos
		// e dentro do exigido pela função
		// observe que solicitei os parametros como sendo do tipo inteiro
		// diretamente sem que sejam algum tipo de estrutura. Isto facilita
		// o acesso aos parametros,
		$funcParams = self::validate_parameters(
		self::get_final_grade_by_user_id_and_course_id_parameters(), // função de validação
		array('userId' =>$userid, 'courseId' =>$courseid) // array com os parametros
		);

		// OK, agora que está tudo ok, consulto no banco de dados a nota
		// do usuário conforme o curso
			
		$grade = grade_get_course_grade($funcParams['userId' ],$funcParams['courseId' ]);
		/*
		 * $grade é um objeto com detalhes da nota dada ao usuário
		* como neste caso informei apenas um curso retorna uma grade, se
		* informar mais de um curso ou nenhum curso retorna um array com
		* todas as notas disponiveis para o curso informado ou para os
		* cursos matriculados respectivamente.
		*
		* $grade->grade			// Nota, obrigatorio
		* $grade->locked			//
		* $grade->hidden			//
		* $grade->overridden		//
		* $grade->feedback			//
		* $grade->feedbackformat	//
		* $grade->usermodified		//
		* $grade->dategraded		//
		* $grade->item				//
		*
		* formato de $grade->item
		* $item->name			// Nome do Item (Por exemplo: Total do Curso)
		* $item->grademin		// Valor Minimo da Nota
		* $item->grademax		// Valor Máximo
		* $item->gradepass		//
		* $item->locked
		* $item->hidden
		*
		*/
		// TODO, estudar melhorias neste retorno.
		$result = array();
		if($grade === false) $result['grade'] = grade_floatval(-9999);
		else if($grade === null) $result['grade'] = grade_floatval(-8888);
		// como informei apenas um curso nos parametros retorna apenas um grade, não retorna array.
		else $result['grade'] = grade_floatval($grade->grade);


		return $result;
	}

	public static function get_final_grade_by_course_id_parameters(){
		return new SistemaAulaFinalGradeByCourseIdParameters();
	}

	public static function get_final_grade_by_course_id_returns(){
		return new SistemaAulaGradesReturn();
	}

	public static function get_final_grade_by_course_id($courseId, $roleId){
		// no MOODLE não temos factories
		// obtemos os acessores diretamente via variaveis globais
		global $CFG;

		require_once($CFG->dirroot.'/grade/lib.php');
		require_once($CFG->dirroot.'/grade/querylib.php');
		require_once($CFG->dirroot.'/user/lib.php');

		// para trabalhar com as grades de notas precisa-se ter
		// as seguintes habilidades:
		// * moodle/grade:export
		// * gradeexprt/txt:view
		// primeiro pego o contexto do sistema com base no usuário corrente
		$context = get_context_instance(CONTEXT_SYSTEM);
		// então verifico as abilidades uma a uma
		require_capability('moodle/grade:export', $context);
		require_capability('gradeexport/txt:view', $context);

		// neste ponto se verifica os parametros informados estão corretos
		// e dentro do exigido pela função
		// observe que solicitei os parametros como sendo do tipo inteiro
		// diretamente sem que sejam algum tipo de estrutura. Isto facilita
		// o acesso aos parametros,
		$funcParams = self::validate_parameters(
		self::get_final_grade_by_course_id_parameters(), // função de validação
		array(
			'courseId'	=>$courseId,
			'roleId'	=>$roleId
		) // array com os parametros

		);

		if(MDEBUG)mDebug_log($funcParams, 'Parametros da Função');

		$usersIds = array();
 
		$context = get_context_instance(CONTEXT_COURSE,$funcParams['courseId']);

		$role = new stdClass();
		$role->id = $roleId;

		$users = get_users_from_role_on_context($role, $context);
		if(MDEBUG)mDebug_log($users);

		$usersIds = array();
		foreach ($users as $user) {
			$usersIds[] = $user->userid;
		}
		if(MDEBUG)mDebug_log($usersIds, 'Ids dos Usuários');

		// OK, agora que está tudo ok, consulto no banco de dados a nota
		// do usuário conforme o curso
		$grades = grade_get_course_grades($funcParams['courseId' ],$usersIds);
		if(MDEBUG)mDebug_log($grades, 'Grades');

		// TODO, estudar melhorias neste retorno.
		foreach ($grades->grades as $userId => $grade) {
			$result = array();

			if($grade === false) $result['grade'] = grade_floatval(-9999);
			else if($grade === null) $result['grade'] = grade_floatval(-8888);
			// como informei apenas um curso nos parametros retorna apenas um grade, não retorna array.
			else $result['grade'] = grade_floatval($grade->grade);

			$result['userId'] = $userId;
			$results[] = $result;
		}
		
		if(MDEBUG)mDebug_log($results, 'Grades finais a serem enviadas');
		return  $results;
	}

}