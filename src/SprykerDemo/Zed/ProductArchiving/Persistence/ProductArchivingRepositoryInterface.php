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
     * @return bool
     */
    public function isSoftDeleteEnabled(): bool;

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return bool
     */
    public function isProductExistsInProductLists(ProductConcreteTransfer $productConcreteTransfer): bool;
}
