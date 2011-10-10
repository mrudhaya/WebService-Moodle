<?
/**
 * 
 * @author extracbd
 *
 */
class SystemaAulaMoodleException extends Exception{

	public $errorcode;
	public $module;
	public $a;
	public $link;
	public $debuginfo;

	function __construct($errorcode, $a=NULL,$debuginfo=NULL) {
		$this->module    = 'SistemaAula';
		$this->link      = 'http://www.sistemaaula.com.br/moodle';

		$this->errorcode = $errorcode;
		$this->a         = $a;
		$this->debuginfo = $debuginfo;

		if (get_string_manager()->string_exists($errorcode, $module)) {
			$message = get_string($errorcode, $module, $a);
		} else {
			if(is_array($a)){
				$a = implode(', ', $a);
			}else if(is_object($a)){
				$a = get_object_vars($a);
				$a = implode(', ', $a);
			}
			$message = "$module / $errorcode ($a)";
		}

		parent::__construct($message, 0);

	}
}
?>