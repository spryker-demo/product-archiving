<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Persistence;

use Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerDemo\Zed\ProductArchiving\ProductArchivingDependencyProvider;

/**
 * @method \SprykerDemo\Zed\ProductArchiving\ProductArchivingConfig getConfig()
 * @method \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingRepositoryInterface getRepository()
 * @method \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingEntityManagerInterface getEntityManager()
 */
class ProductArchivingPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery
     */
    public function createProductListProductConcreteQuery(): SpyProductListProductConcreteQuery
    {
        return $this->getProvidedDependency(ProductArchivingDependencyProvider::QUERY_PRODUCT_LIST_PRODUCT_CONCRETE_QUERY);
    }
}
