<?php
namespace Test\One\Model\ResourceModel\Cards;
/**
 * Test One Cards Collection
 *
 * @package  Test\One\Model\ResourceModel\Cards
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'card_id';
	protected $_eventPrefix = 'test_one_cards_collection';
	protected $_eventObject = 'cards_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Test\One\Model\Cards', 'Test\One\Model\ResourceModel\Cards');
	}

}