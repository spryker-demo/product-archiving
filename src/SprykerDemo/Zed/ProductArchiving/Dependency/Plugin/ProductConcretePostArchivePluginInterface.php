<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Dependency\Plugin;

use Generated\Shared\Transfer\ProductConcreteTransfer;

interface ProductConcretePostArchivePluginInterface
{
    /**
     * Specification:
     * - Is executed after product concrete is archived.
     * - Can be used to perform additional actions.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return void
     */
    public function postArchive(ProductConcreteTransfer $productConcreteTransfer): void;
}
