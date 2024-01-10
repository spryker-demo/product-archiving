<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Business\Archiver;

use Exception;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;
use Spryker\Zed\Product\Business\Product\ProductConcreteActivatorInterface;
use Spryker\Zed\Product\Business\ProductFacadeInterface;
use SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingEntityManagerInterface;
use SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingRepositoryInterface;

class ProductConcreteArchiver implements ProductConcreteArchiverInterface
{
    use TransactionTrait;

    /**
     * @var \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected ProductFacadeInterface $productFacade;

    /**
     * @var \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingEntityManagerInterface
     */
    protected ProductArchivingEntityManagerInterface $productEntityManager;

    /**
     * @var \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingRepositoryInterface
     */
    protected ProductArchivingRepositoryInterface $productRepository;

    /**
     * @var array<\SprykerDemo\Zed\ProductArchiving\Dependency\Plugin\ProductConcretePreArchivePluginInterface>
     */
    protected array $productConcretePreArchivePlugins;

    /**
     * @var array<\SprykerDemo\Zed\ProductArchiving\Dependency\Plugin\ProductConcretePostArchivePluginInterface>
     */
    protected array $productConcretePostArchivePlugins;

    /**
     * @param \Spryker\Zed\Product\Business\ProductFacadeInterface $productFacade
     * @param \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingEntityManagerInterface $productEntityManager
     * @param \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingRepositoryInterface $productRepository
     * @param array<\SprykerDemo\Zed\ProductArchiving\Dependency\Plugin\ProductConcretePreArchivePluginInterface> $productConcretePreArchivePlugins
     * @param array<\SprykerDemo\Zed\ProductArchiving\Dependency\Plugin\ProductConcretePostArchivePluginInterface> $productConcretePostArchivePlugins
     */
    public function __construct(
        ProductConcreteActivatorInterface $productFacade,
        ProductArchivingEntityManagerInterface $productEntityManager,
        ProductArchivingRepositoryInterface $productRepository,
        array $productConcretePreArchivePlugins,
        array $productConcretePostArchivePlugins
    ) {
        $this->productFacade = $productFacade;
        $this->productEntityManager = $productEntityManager;
        $this->productRepository = $productRepository;
        $this->productConcretePreArchivePlugins = $productConcretePreArchivePlugins;
        $this->productConcretePostArchivePlugins = $productConcretePostArchivePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @throws \Exception
     *
     * @return void
     */
    public function archive(ProductConcreteTransfer $productConcreteTransfer): void
    {
        if (!$this->productRepository->isSoftDeleteEnabled()) {
            throw new Exception('SoftDelete is not enabled. Archiving is not possible.');
        }

        //todo check if product presenting in orders product/shopping list. Prevent deletion if it exists there.


        $this->getTransactionHandler()->handleTransaction(function () use ($productConcreteTransfer): void {
            $this->executeArchiveTransaction($productConcreteTransfer);
        });
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return void
     */
    protected function executeArchiveTransaction(ProductConcreteTransfer $productConcreteTransfer): void
    {
        $this->executeProductConcretePreArchivePlugins($productConcreteTransfer);

        $this->productFacade->deactivateProductConcrete($productConcreteTransfer->getIdProductConcrete());
        $this->productEntityManager->archiveProductConcrete($productConcreteTransfer);

        $this->executeProductConcretePostArchivePlugins($productConcreteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return void
     */
    protected function executeProductConcretePreArchivePlugins(ProductConcreteTransfer $productConcreteTransfer): void
    {
        foreach ($this->productConcretePreArchivePlugins as $productConcretePreArchivePlugin) {
            $productConcretePreArchivePlugin->preExecute($productConcreteTransfer);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return void
     */
    protected function executeProductConcretePostArchivePlugins(ProductConcreteTransfer $productConcreteTransfer): void
    {
        foreach ($this->productConcretePostArchivePlugins as $productConcretePostArchivePlugin) {
            $productConcretePostArchivePlugin->postExecute($productConcreteTransfer);
        }
    }
}
