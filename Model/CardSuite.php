<?php
namespace Test\One\Model;
/**
 * Test One CardSuite Model
 *
 * @package  Test\One\Model
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
class CardSuite extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'test_one_cardsuite';

	protected $_cacheTag = 'test_one_cardsuite';

	protected $_eventPrefix = 'test_one_cardsuite';

	/**
     * CardRank constructor
     */
	protected function _construct()
	{
		$this->_init('Test\One\Model\ResourceModel\CardSuite');
	}

	/**
     * Get Identities
     *
     * @return array
     */
	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}
}