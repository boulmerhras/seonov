<?php

namespace Seonov\Customergroup\Model\Plugin;


/**
 * Class Layer
 */
class Layer {
  protected $_customerSession;
  public function __construct(
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->_customerSession = $customerSession;
    }
    public function getCacheLifetime()
    {
        return null;
    }
    public function afterGetProductCollection($subject, $collection) {
      $ObjectManager= \Magento\Framework\App\ObjectManager::getInstance();
      $context = $ObjectManager->get('Magento\Framework\App\Http\Context');
      $isLoggedIn = $context->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
      if($isLoggedIn):
      $groupid = $customerGroup=$this->_customerSession->getCustomer()->getGroupId();
      //echo 'hahaha' . $groupid;
        if ($groupid == 2){
        }else{

          $collection->addAttributeToSelect('*');
          $collection->addAttributeToFilter('customer_group', array('eq' => '35'));
        }
      else:
        //echo 'not logged';
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('customer_group', array('eq' => '35'));
      endif;


        return $collection;
    }
}
