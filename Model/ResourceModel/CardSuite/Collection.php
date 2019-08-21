<?php
namespace Test\One\Model\ResourceModel\CardSuite;
/**
 * Test One CardSuite Collection
 *
 * @package  Test\One\Model\ResourceModel\CardSuite
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'card_suite_id';
	protected $_eventPrefix = 'test_one_cardsuite_collection';
	protected $_eventObject = 'cardsuite_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Test\One\Model\CardSuite', 'Test\One\Model\ResourceModel\CardSuite');
	}
}