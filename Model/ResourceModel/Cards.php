<?php
namespace Test\One\Model\ResourceModel;
/**
 * Test One Cards ResourceModel
 *
 * @package  Test\One\Model\ResourceModel
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
class Cards extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	protected $cardCollection;	

	/**
     * Cards constructor
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
	public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('cards', 'card_id');
	}
	
	/**
     * Get card by suite and rank
     *
     * @param \Test\One\Model\Cards $cards
     * @param int $suite
     * @param int $rank
     * @return array
     */
	public function getCardBySuite(\Test\One\Model\Cards $cards, $suite, $rank)
	{
		$connection = $this->getConnection();
		$bind = ['suite_id' => $suite, 'rank_id' => $rank];
		$select = $connection->select()->from(
            $this->getMainTable(),
            [$this->getIdFieldName()]
        )->where(
            'card_suite_id = :suite_id AND card_rank_id = :rank_id'
        );

        $cardId = $connection->fetchOne($select, $bind);
        return $this->getCardInfo($cardId);
	}

	/**
     * Get random card from deck
     *
     * @param \Test\One\Model\Cards $cards
     * @param array $previouseCards
     * @return array
     */
	public function getDraftCard(\Test\One\Model\Cards $cards, $previouseCards) 
	{
		$allCards = $this->getAllCards($previouseCards);
		$cardIds = [];
		foreach ($allCards as $card) {
			$cardIds[] = $card['card_id'];
		}

		$randomeCardId = array_rand($cardIds);
		return $this->getCardInfo($randomeCardId);
	}

	/**
     * Get total card in deck
     *
     * @param array $previouseCards
     * @return int
     */
	public function getCardTotal($previouseCards)
	{
		$cardCollection = $this->getAllCards($previouseCards);
		return count($cardCollection);
	}

	/**
     * Get all card from database and remove previous drafted cards
     *
     * @param array $previouseCards
     * @return array
     */
	protected function getAllCards($previouseCards)
	{
		$connection = $this->getConnection();
		if(count($previouseCards)) {
			$cardKeys = implode("','", $previouseCards);
			$logger->info("cardKeys: ".$cardKeys);
			$select = $connection->select()->from(
	            $this->getMainTable(),
	            [$this->getIdFieldName()]
	        )->where('status = ?', 1)
	        ->where("cards.key NOT IN ('".$cardKeys."')");
	    } else {
	    	$select = $connection->select()->from(
	            $this->getMainTable(),
	            [$this->getIdFieldName()]
	        )->where('status = ?', 1);
	    }

        return $connection->fetchAll($select);
	}

	/**
     * Get card information by id
     *
     * @param int $cardId
     * @return array
     */
	protected function getCardInfo($cardId) 
	{
		$connection = $this->getConnection();
		$bind = ['card_id' => $cardId];
        $select = $connection->select()->from(
            $this->getMainTable(),
            ['*']
        )->where(
            'card_id = :card_id'
        );
        return $connection->fetchRow($select, $bind);
	}
}