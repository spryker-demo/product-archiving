<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Product\Business\ProductFacadeInterface;
use SprykerDemo\Zed\ProductArchiving\Business\Archiver\ProductConcreteArchiver;
use SprykerDemo\Zed\ProductArchiving\Business\Archiver\ProductConcreteArchiverInterface;
use SprykerDemo\Zed\ProductArchiving\Business\Validator\ProductArchivingValidator;
use SprykerDemo\Zed\ProductArchiving\Business\Validator\ProductArchivingValidatorInterface;
use SprykerDemo\Zed\ProductArchiving\ProductArchivingDependencyProvider;

/**
 * @method \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingRepositoryInterface getRepository()
 * @method \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingEntityManagerInterface getEntityManager()
 */
class ProductArchivingBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerDemo\Zed\ProductArchiving\Business\Archiver\ProductConcreteArchiverInterface
     */
    public function createProductConcreteArchiver(): ProductConcreteArchiverInterface
    {
        return new ProductConcreteArchiver(
            $this->getProductFacade(),
            $this->createProductArchivingValidator(),
            $this->getEntityManager(),
        );
    }

    /**
     * @return \SprykerDemo\Zed\ProductArchiving\Business\Validator\ProductArchivingValidatorInterface
     */
    public function createProductArchivingValidator(): ProductArchivingValidatorInterface
    {
        return new ProductArchivingValidator($this->getRepository());
    }

    /**
     * @return \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    public function getProductFacade(): ProductFacadeInterface
    {
        return $this->getProvidedDependency(ProductArchivingDependencyProvider::FACADE_PRODUCT);
    }
}
