<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Persistence;

use Generated\Shared\Transfer\ProductConcreteTransfer;

interface ProductArchivingRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return bool
     */
    public function productExistsInProductLists(ProductConcreteTransfer $productConcreteTransfer): bool;

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return bool
     */
    public function productExistsInShoppingLists(ProductConcreteTransfer $productConcreteTransfer): bool;

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return bool
     */
    public function productExistsInOrders(ProductConcreteTransfer $productConcreteTransfer): bool;
}
