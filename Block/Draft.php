<?php
namespace Test\One\Block;
/**
 * Test One Draft Block
 *
 * @package  Test\One\Block
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
class Draft extends \Magento\Framework\View\Element\Template
{
	/**
     * @var \Magento\Framework\App\Response\RedirectInterface
     */
	protected $_redirect;

	/**
     * @var \Test\One\Model\Cards
     */
	protected $_cardsModel;

	/**
     * @var \Test\One\Model\Session
     */
	protected $_testOneSession;

	/**
     * @var cardsCollection
     */
	protected $cardsCollection;

	/**
     * @var cardTotal
     */
	protected $cardTotal;

	/**
     * Draft constructor
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\App\Response\RedirectInterface $redirect
     * @param \Test\One\Model\CardsFactory $cardsFactory
     * @param \Test\One\Model\Session $testOneSessio
     * @param array $data
     */
	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Magento\Framework\App\Response\RedirectInterface $redirect,
		\Test\One\Model\Cards $cardsModel,
		\Test\One\Model\Session $testOneSession,
		array $data = []
	) {
		$this->_redirect = $redirect;
		$this->_cardsModel = $cardsModel;
		$this->_testOneSession = $testOneSession;
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
     * Get back action url
     *
     * @return string
     */
	public function getBackAction() 
	{
		return $this->getUrl('testone/');
	}

	/**
     * Get cards from session
     *
     * @return array
     */
	public function getPickedCard() 
	{
	    $post = $this->getPostData();
		return $this->_cardsModel->getCardBySuite($post['suite'], $post['rank']);
	}

	/**
     * Get form data
     *
     * @return array
     */
	public function getPostData() 
	{
		return $this->getRequest()->getPost();	
	}

	/**
     * Get random card from cards in database
     *
     * @return array
     */
	public function getDraftedCard() 
	{
		$previouseCards = $this->getPreviousDraftedCards();
		$randomCard = $this->_cardsModel->getDraftCard($previouseCards);
		$previouseCards[] = $randomCard['key'];
		$this->setDraftedCards($previouseCards);
		return $randomCard;
	}

	/**
     * Get probability of user picked card will be in next draft
     *
     * @return string
     */
	public function getProbabilityPick()
	{
		$previouseCards = $this->getPreviousDraftedCards();
		return $this->_cardsModel->getProbabilityPick($previouseCards);
	}

	/**
     * Get cards from session
     *
     * @return array
     */
	protected function getPreviousDraftedCards() 
	{
	    $cards = $this->_testOneSession->getCards();
	    $redirectUrl = $this->_redirect->getRefererUrl();
	    $previousCards = [];
	    if(strpos($redirectUrl, 'draft') !== false) {
	    	if($cards) {
		    	if(strpos($cards, ',') !== false) {
		    		$previousCards = explode(",", $cards);
		    	} else {
		    		$previousCards[] = $cards;
		    	}
			}
	    }

		return $previousCards;
	}

	/**
     * Set the session value
     *
     * @param array $previouseCards
     */
	protected function setDraftedCards($previouseCards)
	{
		$draft = implode(",", $previouseCards);
		$this->_testOneSession->setCards($draft);
	}
}