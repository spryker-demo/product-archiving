<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Persistence;

use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingPersistenceFactory getFactory()
 */
class ProductArchivingRepository extends AbstractRepository implements ProductArchivingRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return bool
     */
    public function productExistsInProductLists(ProductConcreteTransfer $productConcreteTransfer): bool
    {
        return $this->getFactory()->getProductListProductConcreteQuery()
            ->filterByFkProduct($productConcreteTransfer->getIdProductConcrete())
            ->exists();
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return bool
     */
    public function productExistsInShoppingLists(ProductConcreteTransfer $productConcreteTransfer): bool
    {
        return $this->getFactory()->getShoppingListItemQuery()
            ->filterBySku($productConcreteTransfer->getSku())
            ->exists();
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return bool
     */
    public function productExistsInOrders(ProductConcreteTransfer $productConcreteTransfer): bool
    {
        return $this->getFactory()->getSalesOrderItemQuery()
            ->filterBySku($productConcreteTransfer->getSku())
            ->exists();
    }
}
