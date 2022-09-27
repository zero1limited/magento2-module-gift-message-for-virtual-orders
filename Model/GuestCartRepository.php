<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Zero1\GiftMessageForVirtualOrders\Model;

use Magento\GiftMessage\Api\CartRepositoryInterface;
use Magento\Quote\Model\QuoteIdMaskFactory;

/**
 * Shopping cart gift message repository object for guest
 */
class GuestCartRepository extends \Magento\GiftMessage\Model\GuestCartRepository
{
    /**
     * @param CartRepositoryInterface $repository
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     */
    public function __construct(
        CartRepositoryInterface $repository,
        QuoteIdMaskFactory $quoteIdMaskFactory
    ) {
        $this->repository = $repository;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
    }
}
