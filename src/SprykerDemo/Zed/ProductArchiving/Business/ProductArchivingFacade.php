<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Business;

use Generated\Shared\Transfer\ProductArchivingResponseTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\ProductArchiving\Business\ProductArchivingBusinessFactory getFactory()
 */
class ProductArchivingFacade extends AbstractFacade implements ProductArchivingFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\ProductArchivingResponseTransfer
     */
    public function archiveProductConcrete(ProductConcreteTransfer $productConcreteTransfer): ProductArchivingResponseTransfer
    {
        return $this->getFactory()->createProductConcreteArchiver()->archive($productConcreteTransfer);
    }
}
