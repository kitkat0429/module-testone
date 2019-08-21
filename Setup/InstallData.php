<?php
namespace Test\One\Setup;
/**
 * Test One Setup InstallData
 *
 * @package  Test\One\Setup
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
	/**
     * @var \Test\One\Model\CardSuiteFactory
     */
	protected $_cardSuiteFactory;

	/**
     * @var \Test\One\Model\CardRankFactory
     */
	protected $_cardRankFactory;

	/**
     * @var \Test\One\Model\CardsFactory
     */
	protected $_cardsFactory;

	/**
     * InstallData constructor
     * @param \Test\One\Model\CardSuiteFactory $cardSuiteFactory
     * @param \Test\One\Model\CardRankFactory  $cardRankFactory
     * @param \Test\One\Model\CardsFactory     $cardsFactory
     */
	public function __construct(
		\Test\One\Model\CardSuiteFactory $cardSuiteFactory,
		\Test\One\Model\CardRankFactory  $cardRankFactory,
		\Test\One\Model\CardsFactory     $cardsFactory
	) {
		$this->_cardSuiteFactory = $cardSuiteFactory;
		$this->_cardRankFactory = $cardRankFactory;
		$this->_cardsFactory = $cardsFactory;
	}

	/**
     * Install function
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		/* Create Card Suite Data */
		$cardSuiteData = [
			[
				'key'		=> "H",
				'value'		=> "Hearts",
				'status'	=> 1
			],
			[
				'key'		=> "D",
				'value'		=> "Diamond",
				'status'	=> 1
			],
			[
				'key'		=> "C",
				'value'		=> "Club",
				'status'	=> 1
			],
			[
				'key'		=> "S",
				'value'		=> "Spade",
				'status'	=> 1
			]
		];

		foreach($cardSuiteData as $data) {
			$cardSuite = $this->_cardSuiteFactory->create();
			$cardSuite->addData($data)->save();
		}

		/* Create Card Rank Data */
		$cardRankData = [
			[
				'key'		=> "J",
				'value'		=> "Jack",
				'status'	=> 1
			],
			[
				'key'		=> "Q",
				'value'		=> "Queen",
				'status'	=> 1
			],
			[
				'key'		=> "K",
				'value'		=> "King",
				'status'	=> 1
			],
			[
				'key'		=> "A",
				'value'		=> "Ace",
				'status'	=> 1
			]
		];
		
		for($i = 2; $i < 11; $i++) {
			$rank = [
				'key'		=> $i,
				'value'		=> $i,
				'status'	=> 1
			];
			$cardRank = $this->_cardRankFactory->create();
			$cardRank->addData($rank)->save();
		}
		foreach($cardRankData as $data) {
			$cardRank = $this->_cardRankFactory->create();
			$cardRank->addData($data)->save();
		}

		/* Assign Card Combinations */
		$cardSuiteCollection = $this->_cardSuiteFactory->create()->getCollection();
		$cardRankCollection = $this->_cardRankFactory->create()->getCollection();
		foreach($cardSuiteCollection as $cardsuite) {
			foreach($cardRankCollection as $cardrank) {
				$cardData = [
					'card_suite_id' => $cardsuite->getId(),
					'card_rank_id'	=> $cardrank->getId(),
					'key' 			=> $cardsuite->getKey().$cardrank->getKey(),
					'value' 		=> $cardrank->getValue().' of '.$cardsuite->getValue(),
					'status'		=> 1
				];
				$cards = $this->_cardsFactory->create();
				$cards->addData($cardData)->save();
			}
			
		}
	}
}