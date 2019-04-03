<?php

class Rice_RadItems_Model_Observer extends Mage_Core_Model_Observer
{
	/**
	 * Return quote items that have a half_life below the threshold.
	 * @param Mage_Sales_Model_Quote $quote
	 * @param int $threshold
	 * @return array
	 */
	protected function _getQuoteItemsBelowThreshold(Mage_Sales_Model_Quote $quote, $threshold)
	{
		$quoteItems = $quote->getAllItems();
		$quoteItemsBelowThreshold = array_filter($quoteItems, function($item) use ($threshold) {
			/* @var Mage_Sales_Model_Quote_Item $item */
			$halfLife = $item->getProduct()->getHalfLife();
			return ($halfLife && $halfLife < $threshold);
		});
		return $quoteItemsBelowThreshold;
	}

	/**
	 * Record whether order contains any radioactive items.
	 * @param Varien_Event_Observer $observer
	 * @return $this
	 * @see Mage_Sales_Model_Convert_Quote::toOrder
	 * @throws Varien_Exception
	 */
	public function setContainsRadioactiveItem(Varien_Event_Observer $observer)
	{
		/* @var Mage_Sales_Model_Quote $quote */
		$quote = $observer->getQuote();
		/* @var Rice_RadItems_Helper_Data $helper */
		$helper = Mage::helper('rice_raditems');
		$threshold = $helper->getHalfLifeThreshold();
		$quoteItemsBelowThreshold = $this->_getQuoteItemsBelowThreshold($quote, $threshold);
		if (!empty($quoteItemsBelowThreshold)) {
			/* @var Mage_Sales_Model_Order $order */
			$order = $observer->getOrder();
			$order->setContainsRadioactiveItem(true);
		}
		return $this;
	}

	/**
	 * Add radioactive items notice to order view pages.
	 * @param Varien_Event_Observer $observer
	 * @return $this
	 * @throws Varien_Exception
	 */
	public function addRadioactiveItemNotice(Varien_Event_Observer $observer)
	{
		/* @var Mage_Core_Controller_Varien_Action $action */
		$action = $observer->getAction();
		$route = $action->getFullActionName();
		if (in_array($route, ['sales_order_view', 'sales_guest_view', 'adminhtml_sales_order_view'])) {
			/* @var Mage_Sales_Model_Order $order */
			$order = Mage::registry('current_order');
			if ($order && $order->getContainsRadioactiveItem()) {
				/* @var Rice_RadItems_Helper_Data $helper */
				$helper = Mage::helper('rice_raditems');
				/* @var Mage_Core_Model_Session_Abstract $session */
				$session = Mage::getSingleton($helper->isAdminhtml()? 'adminhtml/session' : 'core/session');
				$session->addNotice($helper->__('Order Contains Radioactive Items!'));
			}
		}
		return $this;
	}
}
