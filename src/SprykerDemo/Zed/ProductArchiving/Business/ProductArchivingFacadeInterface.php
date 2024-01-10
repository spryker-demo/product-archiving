<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Business;

use Generated\Shared\Transfer\ProductConcreteTransfer;

interface ProductArchivingFacadeInterface
{
    /**
     * Specification:
     * - Executes `ProductConcreteBeforeArchivePluginInterface` plugins stack.
     * - Marks product as deleted using `soft_delete` behavior.
     * - Executes `ProductConcreteAfterArchivePluginInterface` plugins stack.
     * - Triggers `Product.product_concrete.unpublish` event for corresponding product.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return void
     */
    public function archiveProductConcrete(ProductConcreteTransfer $productConcreteTransfer): void;
}
