<?php

class Rice_RadItems_Helper_Data extends Mage_Core_Helper_Abstract
{
	/**
	 * Check whether current layout area is adminhtml or not.
	 * @return bool
	 */
	public function isAdminhtml()
	{
		return Mage::getDesign()->getArea() === 'adminhtml';
	}

	/**
	 * Retrieve the configured half-life threshold to consider an item radioactive.
	 * @return int
	 */
	public function getHalfLifeThreshold()
	{
		$value = (int) Mage::getStoreConfig('sales/rice_raditems/half_life_threshold');
		return $value;
	}
}
