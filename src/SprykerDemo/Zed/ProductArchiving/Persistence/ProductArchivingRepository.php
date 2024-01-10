<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Persistence;

use Generated\Shared\Transfer\ProductConcreteTransfer;
use Orm\Zed\Product\Persistence\Base\SpyProductQuery;
use Spryker\Zed\Product\Persistence\ProductRepository as SprykerProductRepository;

/**
 * @method \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingPersistenceFactory getFactory()
 */
class ProductArchivingRepository extends SprykerProductRepository implements ProductArchivingRepositoryInterface
{
    /**
     * @return bool
     */
    public function isSoftDeleteEnabled(): bool
    {
        return method_exists(SpyProductQuery::class, 'isSoftDeleteEnabled')
            && SpyProductQuery::isSoftDeleteEnabled();
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return bool
     */
    public function isProductExistsInProductLists(ProductConcreteTransfer $productConcreteTransfer): bool
    {
        return $this->getFactory()->createProductListProductConcreteQuery()
            ->filterByFkProduct($productConcreteTransfer->getIdProductConcrete())
            ->exists();
    }
}
