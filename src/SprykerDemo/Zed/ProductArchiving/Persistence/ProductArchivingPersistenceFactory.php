<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Persistence;

use Orm\Zed\Product\Persistence\SpyProductQuery;
use Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery;
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
    public function getProductListProductConcreteQuery(): SpyProductListProductConcreteQuery
    {
        return $this->getProvidedDependency(ProductArchivingDependencyProvider::QUERY_PRODUCT_LIST_PRODUCT_CONCRETE_QUERY);
    }

    /**
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery
     */
    public function getShoppingListItemQuery(): SpyShoppingListItemQuery
    {
        return $this->getProvidedDependency(ProductArchivingDependencyProvider::QUERY_SHOPPING_LIST_ITEM_QUERY);
    }

    /**
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery
     */
    public function getSalesOrderItemQuery(): SpySalesOrderItemQuery
    {
        return $this->getProvidedDependency(ProductArchivingDependencyProvider::QUERY_SALES_ORDER_ITEM_QUERY);
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery
     */
    public function getProductQuery(): SpyProductQuery
    {
        return $this->getProvidedDependency(ProductArchivingDependencyProvider::QUERY_PRODUCT_QUERY);
    }
}
