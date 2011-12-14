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

class sistemaaula_grade_external extends external_api {



	public static function get_final_grade_by_user_id_and_course_id_parameters() {
		return new external_function_parameters(
		array(
              'userid'      => new external_value(PARAM_INT, 'Id do Usuário em formato Inteiro'),
              'courseid'    => new external_value(PARAM_INT, 'ID do Curso em formato Inteiro')
		)
		);
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

		require_once $CFG->dirroot.'/grade/lib.php';
		require_once $CFG->dirroot.'/grade/querylib.php';
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
		$params = self::validate_parameters(
		self::get_final_grade_by_user_id_teste_parameters(), // função de validação
		array('userid'=>$userid,'courseid'=>$courseid) // array com os parametros
		);

		// OK, agora que está tudo ok, consulto no banco de dados a nota
		// do usuário conforme o curso
			
		$grades = grade_get_course_grade($userid,$courseid);
		/*
		 * $grades é um array de grade no formato:
		*
		* $grade->grade			// Nota
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
			
		if($grades === false)return -9999;
		if($grades === null) return -8888;
		// como informei apenas um curso nos parametros retorna apenas um grade, não retorna array.
		if(empty($grades->grade))return -1;

		return $grades->grade;
		return 0;

	}


	/**
	 * Returns description of method result value
	 * @return external_description
	 */
	public static function get_final_grade_by_user_id_and_course_id_returns() {
		return new external_value(PARAM_FLOAT,"A nota final do usuário" );
	}

}