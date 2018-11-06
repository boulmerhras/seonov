<?php

namespace Seonov\Customergroup\Plugin;

use Magento\Catalog\Block\Product\ListProduct;
use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class ListProductPlugin
 */
class ListProductPlugin
{
  protected $_customerSession;

  public function __construct(
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->_customerSession = $customerSession;
    }
    /**
     * @param ListProduct $subject
     * @param AbstractCollection $resultCollection
     * @return AbstractCollection
     * @throws LocalizedException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetLoadedProductCollection(
        ListProduct $subject,
        AbstractCollection $resultCollection
    ) {
        if($this->_customerSession->isLoggedIn()):
        $groupid = $customerGroup=$this->_customerSession->getCustomer()->getGroupId();
        //echo $groupid;
          if ($groupid == 'Wholesaler'){

          }else{

            $resultCollection->addAttributeToSelect('customergroup');
            $resultCollection->addAttributeToFilter('customergroup', array('eq' => '35'));
          }
        else:
          //echo 'not logged';
          $resultCollection->addAttributeToSelect('customergroup');
          $resultCollection->addAttributeToFilter('customergroup', array('eq' => '35'));
        endif;

        return $resultCollection;
    }
}
