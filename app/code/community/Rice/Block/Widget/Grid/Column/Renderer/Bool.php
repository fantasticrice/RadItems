<?php

class Rice_RadItems_Block_Widget_Grid_Column_Renderer_Bool extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Number
{
	const VALUES = [
		'0' => 'No',
		'1' => 'Yes'
	];

	/**
	 * Convert boolean values from the number renderer output to readable bool value.
	 * @param Varien_Object $row
	 * @return string
	 */
	protected function _getValue(Varien_Object $row)
	{
		$value = parent::_getValue($row);
		if (isset(self::VALUES[$value])) {
			$value = self::VALUES[$value];
		}
		return $value;
	}
}
