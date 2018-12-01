<?php
/**
 * @author Nikolai Kordulla
 */

namespace jswei\push\sdk\geTui\protobuf\type;

use jswei\push\sdk\geTui\protobuf\PBMessage;
class PBScalar extends \jswei\push\sdk\geTui\protobuf\PBMessage
{
	/**
	 * Set scalar value
	 */
	public function set_value($value)
	{	
		$this->value = $value;	
	}

	/**
	 * Get the scalar value
	 */
	public function get_value()
	{
		return $this->value;
	}
}
?>
