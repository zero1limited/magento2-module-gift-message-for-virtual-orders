<?php
namespace Zero1\GiftMessageForVirtualOrders\Plugin\Magento\GiftMessage\Model;

use Magento\GiftMessage\Helper\Message as GiftMessageHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class GiftMessageConfigProvider
 */
class GiftMessageConfigProvider
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfiguration;

    /**
     * GiftMessageConfigProvider constructor.
     *
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ){
        $this->scopeConfiguration = $context->getScopeConfig();
    }

    //function beforeMETHOD($subject, $arg1, $arg2){}
    //function aroundMETHOD($subject, $proceed, $arg1, $arg2){return $proceed($arg1, $arg2);}
    //function afterMETHOD($subject, $result){return $result;}

    public function afterGetConfig($subject, $result)
    {
        $orderLevelGiftMsg = $this->scopeConfiguration->isSetFlag(
            GiftMessageHelper::XPATH_CONFIG_GIFT_MESSAGE_ALLOW_ORDER,
            ScopeInterface::SCOPE_STORE
        );

        if ($orderLevelGiftMsg && !$result['isOrderLevelGiftOptionsEnabled']) {
            $result['isOrderLevelGiftOptionsEnabled'] = true;
        }

        return $result;
    }
}
