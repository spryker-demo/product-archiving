<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Persistence;

use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Product\Persistence\ProductEntityManager as SprykerProductEntityManager;

class ProductArchivingEntityManager extends SprykerProductEntityManager implements ProductArchivingEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return void
     */
    public function archiveProductConcrete(ProductConcreteTransfer $productConcreteTransfer): void
    {
        $productConcreteEntity = $this->getFactory()->createProductQuery()
            ->filterByIdProduct($productConcreteTransfer->getIdProductConcrete())
            ->findOne();

        if (!$productConcreteEntity) {
            return;
        }

        $productConcreteEntity->delete();
    }
}
