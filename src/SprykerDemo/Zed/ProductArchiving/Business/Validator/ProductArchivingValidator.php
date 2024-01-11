<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\ProductArchiving\Business\Validator;

use Generated\Shared\Transfer\ProductArchivingErrorTransfer;
use Generated\Shared\Transfer\ProductArchivingResponseTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Orm\Zed\Product\Persistence\Base\SpyProductQuery;
use SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingRepositoryInterface;

class ProductArchivingValidator implements ProductArchivingValidatorInterface
{
    /**
     * @var string
     */
    protected const ERROR_SOFT_DELETE_IS_NOT_ENABLED = 'SoftDelete is not enabled. Archiving is not possible.';

    /**
     * @var string
     */
    protected const ERROR_PRODUCT_EXISTS_IN_ORDERS = 'Product exists in orders.';

    /**
     * @var string
     */
    protected const ERROR_PRODUCT_EXISTS_IN_PRODUCT_LISTS = 'Product exists in product lists.';

    /**
     * @var string
     */
    protected const ERROR_PRODUCT_EXISTS_IN_SHOPPING_LISTS = 'Product exists in shopping lists.';

    /**
     * @var \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingRepositoryInterface
     */
    protected ProductArchivingRepositoryInterface $repository;

    /**
     * @param \SprykerDemo\Zed\ProductArchiving\Persistence\ProductArchivingRepositoryInterface $repository
     */
    public function __construct(ProductArchivingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\ProductArchivingResponseTransfer
     */
    public function validateProductConcreteForArchiving(ProductConcreteTransfer $productConcreteTransfer): ProductArchivingResponseTransfer
    {
        $productArchivingResponseTransfer = (new ProductArchivingResponseTransfer())->setIsSuccess(true);

        if (!$this->isSoftDeleteEnabled()) {
            $this->addErrorMessage(static::ERROR_SOFT_DELETE_IS_NOT_ENABLED, $productArchivingResponseTransfer);

            return $productArchivingResponseTransfer;
        }

        if ($this->repository->productExistsInOrders($productConcreteTransfer)) {
            $this->addErrorMessage(static::ERROR_PRODUCT_EXISTS_IN_ORDERS, $productArchivingResponseTransfer);
        }

        if ($this->repository->productExistsInProductLists($productConcreteTransfer)) {
            $this->addErrorMessage(static::ERROR_PRODUCT_EXISTS_IN_PRODUCT_LISTS, $productArchivingResponseTransfer);
        }

        if ($this->repository->productExistsInShoppingLists($productConcreteTransfer)) {
            $this->addErrorMessage(static::ERROR_PRODUCT_EXISTS_IN_SHOPPING_LISTS, $productArchivingResponseTransfer);
        }

        return $productArchivingResponseTransfer;
    }

    /**
     * @return bool
     */
    protected function isSoftDeleteEnabled(): bool
    {
        return method_exists(SpyProductQuery::class, 'isSoftDeleteEnabled')
            && SpyProductQuery::isSoftDeleteEnabled();
    }

    /**
     * @param string $errorMessage
     * @param \Generated\Shared\Transfer\ProductArchivingResponseTransfer $productArchivingResponseTransfer
     *
     * @return void
     */
    protected function addErrorMessage(string $errorMessage, ProductArchivingResponseTransfer $productArchivingResponseTransfer): void
    {
        $productArchivingErrorTransfer = (new ProductArchivingErrorTransfer())->setMessage($errorMessage);

        $productArchivingResponseTransfer->setIsSuccess(false);
        $productArchivingResponseTransfer->addError($productArchivingErrorTransfer);
    }
}
