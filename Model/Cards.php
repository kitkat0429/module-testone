<?php
namespace Test\One\Model;
/**
 * Test One Cards Model
 *
 * @package  Test\One\Model
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
class Cards extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'test_one_cards';

	protected $_cacheTag = 'test_one_cards';

	protected $_eventPrefix = 'test_one_cards';

	protected $pickedCardInfo;

	protected $draftCardInfo;

	/**
     * CardRank constructor
     */
	protected function _construct()
	{
		$this->_init('Test\One\Model\ResourceModel\Cards');
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

	/**
     * Get card by suite and rank
     *
     * @param int $suite
     * @param int $rank
     * @return array
     */
	public function getCardBySuite($suite, $rank)
    {
        return $this->_getResource()->getCardBySuite($this, $suite, $rank);
    }

    /**
     * Get random card from deck
     *
     * @param array previouseCards
     * @return array
     */
    public function	getDraftCard($previouseCards)
    {
		return $this->_getResource()->getDraftCard($this, $previouseCards);
    }

    /**
     * Get probability calculation for next card to match
     *
     * @param array previouseCards
     * @return array
     */
    public function getProbabilityPick($previouseCards) 
    {
		$allCards = $this->_getResource()->getCardTotal($previouseCards);
		$probabilityPercent = ( 1 / $allCards ) * 100;
		return round($probabilityPercent, 2)."%";
    }
}