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
            $this->getEntityManager(),
            $this->getRepository(),
            $this->getProductConcretePreArchivePlugins(),
            $this->getProductConcretePostArchivePlugins(),
        );
    }

//    /**
//     * @return \SprykerDemo\Zed\ProductArchiving\Business\Trigger\ProductEventTriggerInterface
//     */
//    public function createProductEventTrigger(): ProductEventTriggerInterface
//    {
//        return new ProductEventTrigger($this->getEventFacade());
//    }

    /**
     * @return array<\SprykerDemo\Zed\ProductArchiving\Dependency\Plugin\ProductConcretePreArchivePluginInterface>
     */
    public function getProductConcretePreArchivePlugins(): array
    {
        return $this->getProvidedDependency(ProductArchivingDependencyProvider::PLUGINS_PRODUCT_CONCRETE_PRE_ARCHIVE);
    }

    /**
     * @return <\SprykerDemo\Zed\ProductArchiving\Dependency\Plugin\ProductConcretePostArchivePluginInterface>
     */
    public function getProductConcretePostArchivePlugins(): array
    {
        return $this->getProvidedDependency(ProductArchivingDependencyProvider::PLUGINS_PRODUCT_CONCRETE_POST_ARCHIVE);
    }

    /**
     * @return \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    public function getProductFacade(): ProductFacadeInterface
    {
        return $this->getProvidedDependency(ProductArchivingDependencyProvider::FACADE_PRODUCT);
    }
}
