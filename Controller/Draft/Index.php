<?php
namespace Test\One\Controller\Draft;
/**
 * Test One Index
 *
 * @package  Test\One\Controller
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
class Index extends \Magento\Framework\App\Action\Action
{
	/**
     * @var \Magento\Framework\View\Result\PageFactory $pageFactory
     */
	protected $_pageFactory;

	/**
     * Index constructor
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     */
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory
	) {
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	/**
     * execute
     *
     * @return object
     */
	public function execute()
	{
		return $this->_pageFactory->create();
	}
}