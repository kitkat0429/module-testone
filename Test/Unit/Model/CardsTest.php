<?php 
namespace Test\One\Test\Unit\Model;
/**
 * Test One Unit Testing
 *
 * @package  Test\One\Test\Unit\Model
 * @author   Catherine Zuniga <kitkat21@gmail.com>
 */
class CardsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * setUp
     *
     * @return void
     */
    public function setUp() 
    {
        $this->_objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->_cards = $this->_objectManager->getObject("Test\One\Model\Cards");
    } 

    /**
     * Test getCardBySuite
     */
    public function testGetCardBySuite()
    {
        $suite = 2;
        $rank = 3;

        $actualResult = $this->_cards->getCardBySuite($suite, $rank);
        $this->_desiredResult = [
            'key' => 'D4',
            'value' => '4 of Diamond',
        ];
        $this->_actulResult['key'] = $actualResult['key'];
        $this->_actulResult['value'] = $actualResult['value'];
       
         $this->assertEquals($this->_desiredResult, $this->_actulResult);
    }

    /**
     * Test getProbabilityPick
     */
    public function testGetProbabilityPick()
    {
        $previouseCards = 'H2';

        $this->_actulResult = $this->_cards->getProbabilityPick($previouseCards);
        $this->_desiredResult = '1.92%';
       
         $this->assertEquals($this->_desiredResult, $this->_actulResult);
    }
}