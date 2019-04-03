<?php

class Rice_RadItems_Block_Widget_Grid_Column_Filter_Bool extends Mage_Adminhtml_Block_Widget_Grid_Column_Filter_Radio
{
	/**
	 * Basically just needed to restore the result to the grandparent method, but could not descend from it because
	 * we want the @see Mage_Adminhtml_Block_Widget_Grid_Column_Filter_Radio::_getOptions of the parent instead.
	 * @return array|null
	 */
	public function getCondition()
	{
		return Mage_Adminhtml_Block_Widget_Grid_Column_Filter_Select::getCondition();
	}
}
