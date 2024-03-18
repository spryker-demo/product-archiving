<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Business\Archiver;

use Generated\Shared\Transfer\ProductArchivingResponseTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;
use Spryker\Zed\Product\Business\ProductFacadeInterface;
use SprykerDemo\Zed\ProductArchiving\Business\Validator\ProductArchivingValidatorInterface;
use SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingEntityManagerInterface;

class ProductConcreteArchiver implements ProductConcreteArchiverInterface
{
    use TransactionTrait;

    /**
     * @var \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected ProductFacadeInterface $productFacade;

    /**
     * @var \SprykerDemo\Zed\ProductArchiving\Business\Validator\ProductArchivingValidatorInterface
     */
    protected ProductArchivingValidatorInterface $productArchivingValidator;

    /**
     * @var \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingEntityManagerInterface
     */
    protected ProductArchivingEntityManagerInterface $entityManager;

    /**
     * @param \Spryker\Zed\Product\Business\ProductFacadeInterface $productFacade
     * @param \SprykerDemo\Zed\ProductArchiving\Business\Validator\ProductArchivingValidatorInterface $productArchivingValidator
     * @param \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingEntityManagerInterface $entityManager
     */
    public function __construct(
        ProductFacadeInterface $productFacade,
        ProductArchivingValidatorInterface $productArchivingValidator,
        ProductArchivingEntityManagerInterface $entityManager
    ) {
        $this->productFacade = $productFacade;
        $this->productArchivingValidator = $productArchivingValidator;
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\ProductArchivingResponseTransfer
     */
    public function archive(ProductConcreteTransfer $productConcreteTransfer): ProductArchivingResponseTransfer
    {
        $productArchivingResponseTransfer = $this->productArchivingValidator
            ->validateProductForArchiving($productConcreteTransfer);

        if (!$productArchivingResponseTransfer->getIsSuccess()) {
            return $productArchivingResponseTransfer;
        }

        $this->getTransactionHandler()->handleTransaction(function () use ($productConcreteTransfer): void {
            $this->executeArchiveTransaction($productConcreteTransfer);
        });

        return $productArchivingResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return void
     */
    protected function executeArchiveTransaction(ProductConcreteTransfer $productConcreteTransfer): void
    {
        $this->productFacade->deactivateProductConcrete($productConcreteTransfer->getIdProductConcrete());
        $this->entityManager->archiveProductConcrete($productConcreteTransfer);
    }
}
