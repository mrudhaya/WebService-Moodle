<?php

require_once("$CFG->libdir/externallib.php");

class SistemaAulaUsersReturns extends external_multiple_structure{

	function SistemaAulaUsersReturns() {
		parent::__construct(
		new external_single_structure(
		array(
                    'id'       => new external_value(PARAM_INT, 'user id'),
                    'username' => new external_value(PARAM_RAW, 'user name'),
		)
		)
		);
	}
}