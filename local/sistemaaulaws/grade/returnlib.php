<?php

require_once("$CFG->libdir/externallib.php");

/**
 * Objeto usado para retorno da grade de nota final ou atvidade.
 * Pode ser usado para retornar a nota final calculada ou de uma unica atividade
 * de um usuário.
 *
 * Irá seguir a seguinte estrutura:
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
 * @author Carlos Delfino
 *
 */
class SistemaAulaGradeReturn extends external_single_structure{
	function SistemaAulaGradeReturn() {

		parent::__construct(
		array(
				'userId' => new external_value(PARAM_INT  ,"Id do Usuário no qual a grade pertence",VALUE_OPTIONAL),
				'grade'  => new external_value(PARAM_FLOAT,"A nota final do usuário",VALUE_REQUIRED,-1)
		), 'Grade com detalhes da avaliação ou nota final do usuário.'
		);

	}
}
class SistemaAulaGradesReturn extends external_multiple_structure{
	function SistemaAulaGradesReturn() {

		parent::__construct(new external_single_structure(
		array(
				'userId' => new external_value(PARAM_INT  ,"Id do Usuário no qual a grade pertence",VALUE_REQUIRED),
				'grade'  => new external_value(PARAM_FLOAT,"A nota final do usuário",VALUE_REQUIRED,-1)
		), 'Grade com detalhes da avaliação ou nota final do usuário.'
		));

	}
}
?>