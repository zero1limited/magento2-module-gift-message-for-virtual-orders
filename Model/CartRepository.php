<?php
namespace Zero1\GiftMessageForVirtualOrders\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;

/**
 * Class CartRepositoryInterface
 */
class CartRepository extends \Magento\GiftMessage\Model\CartRepository implements \Magento\GiftMessage\Api\CartRepositoryInterface
{
/**
     * {@inheritDoc}
     */
    public function save($cartId, \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage)
    {
        /**
         * Quote.
         *
         * @var \Magento\Quote\Model\Quote $quote
         */
        $quote = $this->quoteRepository->getActive($cartId);

        if (0 == $quote->getItemsCount()) {
            throw new InputException(__("Gift messages can't be used for an empty cart. Add an item and try again."));
        }

        // if ($quote->isVirtual()) {
        //     throw new InvalidTransitionException(__("Gift messages can't be used for virtual products."));
        // }
        $messageText = $giftMessage->getMessage();
        if ($messageText && !$this->helper->isMessagesAllowed('quote', $quote, $this->storeManager->getStore())) {
            throw new CouldNotSaveException(__("The gift message isn't available."));
        }
        $this->giftMessageManager->setMessage($quote, 'quote', $giftMessage);
        return true;
    }
}
