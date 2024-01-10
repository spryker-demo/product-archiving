<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving;

use Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \SprykerDemo\Zed\ProductArchiving\ProductArchivingConfig getConfig()
 */
class ProductArchivingDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_PRODUCT = 'FACADE_PRODUCT';

    /**
     * @var string
     */
    public const QUERY_PRODUCT_LIST_PRODUCT_CONCRETE_QUERY = 'QUERY_PRODUCT_LIST_PRODUCT_CONCRETE_QUERY';

    /**
     * @var string
     */
    public const PLUGINS_PRODUCT_CONCRETE_PRE_ARCHIVE = 'PLUGINS_PRODUCT_CONCRETE_PRE_ARCHIVE';

    /**
     * @var string
     */
    public const PLUGINS_PRODUCT_CONCRETE_POST_ARCHIVE = 'PLUGINS_PRODUCT_CONCRETE_POST_ARCHIVE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addProductConcretePreArchivePlugins($container);
        $container = $this->addProductConcretePostArchivePlugins($container);
        $container = $this->addProductFacade($container);

        return $container;
    }

    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addProductListProductConcreteQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductConcretePreArchivePlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRODUCT_CONCRETE_PRE_ARCHIVE, function () {
            return $this->getProductConcretePreArchivePlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductConcretePostArchivePlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRODUCT_CONCRETE_POST_ARCHIVE, function () {
            return $this->getProductConcretePostArchivePlugins();
        });

        return $container;
    }

    /**
     * @return array<\SprykerDemo\Zed\ProductArchiving\Dependency\Plugin\ProductConcretePreArchivePluginInterface>
     */
    protected function getProductConcretePreArchivePlugins(): array
    {
        return [];
    }

    /**
     * @return array<\SprykerDemo\Zed\ProductArchiving\Dependency\Plugin\ProductConcretePostArchivePluginInterface>
     */
    protected function getProductConcretePostArchivePlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListProductConcreteQuery(Container $container): Container
    {
        $container->set(static::QUERY_PRODUCT_LIST_PRODUCT_CONCRETE_QUERY, $container->factory(function () {
            return SpyProductListProductConcreteQuery::create();
        }));

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductFacade(Container $container): Container
    {
        $container->set(static::FACADE_PRODUCT, function (Container $container) {
            return $container->getLocator()->product()->facade();
        });

        return $container;
    }
}
