<?php
namespace Test\One\Model\ResourceModel\CardRank;
/**
 * Test One CardRank Collection
 *
 * @package  Test\One\Model\ResourceModel\CardRank
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'card_rank_id';
	protected $_eventPrefix = 'test_one_cardrank_collection';
	protected $_eventObject = 'cardrank_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Test\One\Model\CardRank', 'Test\One\Model\ResourceModel\CardRank');
	}

}