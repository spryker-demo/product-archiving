<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Business;

use Generated\Shared\Transfer\ProductArchivingResponseTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;

interface ProductArchivingFacadeInterface
{
    /**
     * Specification:
     * - Checks whether the product can be archived.
     * - Executes `ProductConcretePreArchivePluginInterface` plugins stack.
     * - Deactivates product concrete.
     * - Marks product as deleted using `soft_delete` behavior.
     * - Executes `ProductConcretePostArchivePluginInterface` plugins stack.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\ProductArchivingResponseTransfer
     */
    public function archiveProductConcrete(ProductConcreteTransfer $productConcreteTransfer): ProductArchivingResponseTransfer;
}
