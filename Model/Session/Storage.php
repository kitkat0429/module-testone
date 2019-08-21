<?php
namespace Test\One\Model\Session;
/**
 * Test One Session Storage
 *
 * @package  Test\One\Model\Session
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
class Storage extends \Magento\Framework\Session\Storage
{
    /**
     * Storage constructor
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param string $namespace
     * @param array $data
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        $namespace = 'testone',
        array $data = []
    ) {
        parent::__construct($namespace, $data);
    }
}