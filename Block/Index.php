<?php
namespace Test\One\Block;
/**
 * Test One Index Block
 *
 * @package  Test\One\Block
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
class Index extends \Magento\Framework\View\Element\Template
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
     * Index constructor
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Test\One\Model\CardSuiteFactory $cardSuiteFactory
     * @param \Test\One\Model\CardRankFactory  $cardRankFactory
     * @param array $data
     */
	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Test\One\Model\CardSuiteFactory $cardSuiteFactory,
		\Test\One\Model\CardRankFactory  $cardRankFactory,
		array $data = []
	) {
		$this->_cardSuiteFactory = $cardSuiteFactory;
		$this->_cardRankFactory = $cardRankFactory;
		parent::__construct($context, $data);
	}

	/**
     * Get form action url
     *
     * @return string
     */
	public function getFormAction()
	{	
		return $this->getUrl('testone/draft/');
	}

	/**
     * Get available card suites from database
     *
     * @return object
     */
	public function getCardSuiteOptions()
	{
		return $this->_cardSuiteFactory->create()->getCollection()->addFieldToFilter('status', array('eq' => 1));
	}

	/**
     * Get available card rank from database
     *
     * @return object
     */
	public function getCardRankOptions()
	{
		return $this->_cardRankFactory->create()->getCollection()->addFieldToFilter('status', array('eq' => 1));
	}

}