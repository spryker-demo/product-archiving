<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Business;

use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Product\Business\ProductFacade as SprykerProductFacade;

/**
 * @method \SprykerDemo\Zed\ProductArchiving\Business\ProductArchivingBusinessFactory getFactory()
 */
class ProductArchivingFacade extends SprykerProductFacade implements ProductArchivingFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return void
     */
    public function archiveProductConcrete(ProductConcreteTransfer $productConcreteTransfer): void
    {
        $this->getFactory()->createProductConcreteArchiver()->archive($productConcreteTransfer);
    }
}
