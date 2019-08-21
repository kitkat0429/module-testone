<?php
namespace Test\One\Model\ResourceModel;
/**
 * Test One CardSuite ResourceModel
 *
 * @package  Test\One\Model\ResourceModel
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
class CardSuite extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	/**
     * CardSuite constructor
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
	public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('card_suite', 'card_suite_id');
	}
	
}