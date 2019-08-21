<?php
namespace Test\One\Model;
/**
 * Test One CardRank Model
 *
 * @package  Test\One\Model
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
class Session extends \Magento\Framework\Session\SessionManager
{
	/**
     * @var \Magento\Framework\Session\Generic
     */
	protected $_session;
	
	/**
     * @var _coreUrl
     */
	protected $_coreUrl = null;
	
	/**
     * @var _configShare
     */
	protected $_configShare;
	
	/**
     * @var _urlFactory
     */
	protected $_urlFactory;
	/**
     * @var \Magento\Framework\Event\ManagerInterface
     */
	protected $_eventManager;
	/**
     * @var \Magento\Framework\App\Response\Http
     */
	protected $response;
	/**
     * @var _sessionManager
     */
	protected $_sessionManager;

	/**
     * Session constructor
     * @param \Magento\Framework\App\Request\Http $request
     * @param \Magento\Framework\Session\SidResolverInterface $sidResolver
     * @param \Magento\Framework\Session\Config\ConfigInterface $sessionConfig
     * @param \Magento\Framework\Session\SaveHandlerInterface $saveHandler
     * @param \Magento\Framework\Session\ValidatorInterface $validator
     * @param \Magento\Framework\Session\StorageInterface $storage
     * @param \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager
     * @param \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param \Magento\Framework\App\State $appState
     * @param \Magento\Framework\Session\Generic $session
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Framework\App\State $appState
     * @param \Magento\Framework\App\Response\Http $response
     */
	public function __construct(
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Session\SidResolverInterface $sidResolver,
        \Magento\Framework\Session\Config\ConfigInterface $sessionConfig,
        \Magento\Framework\Session\SaveHandlerInterface $saveHandler,
        \Magento\Framework\Session\ValidatorInterface $validator,
        \Magento\Framework\Session\StorageInterface $storage,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
        \Magento\Framework\App\Http\Context $httpContext,
        \Magento\Framework\App\State $appState,
        \Magento\Framework\Session\Generic $session,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\App\Response\Http $response
    ) {
        $this->_session = $session;
        $this->_eventManager = $eventManager;
 
        parent::__construct(
            $request,
            $sidResolver,
            $sessionConfig,
            $saveHandler,
            $validator,
            $storage,
            $cookieManager,
            $cookieMetadataFactory,
            $appState
        );
        $this->response = $response;
        $this->_eventManager->dispatch('test_one_init', ['test_one' => $this]);
    } 
}