<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Business\Validator;

use Generated\Shared\Transfer\ProductConcreteTransfer;

class ProductArchivingValidator implements ProductArchivingValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return bool
     */
    public function validateProductConcreteForArchiving(ProductConcreteTransfer $productConcreteTransfer): bool
    {
        return false;
    }
}
