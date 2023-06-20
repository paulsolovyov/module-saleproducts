<?php

declare(strict_types=1);

namespace PaulSolovyov\SaleProducts\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use PaulSolovyov\SaleProducts\Logger\Logger;

class SetSaleProductTitleManagement implements \PaulSolovyov\SaleProducts\Api\ProductInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $_productRepository;

    /**
     * @var Logger
     */
    private $_logger;

    public function __construct(
        ProductRepositoryInterface $_productRepository,
        Logger $_logger
    ) {
        $this->_productRepository = $_productRepository;
        $this->_logger = $_logger;
    }

    /**
     * Sets Product Short Description to "ON SALE!!!"
     *
     * @param int $id
     * @return string
     */
    public function setSaleProductTitle($id)
    {
        try {

            $product = $this->_productRepository->getById($id);
            $product->setShortDescription("ON SALE!!!");
            $this->_productRepository->save($product);
            return "Product Updated";

        } catch (LocalizedException $e) {

            $this->_logger->info("This product doesn't exist: " . $id);
            return "This product doesn't exist";

        } catch (CouldNotSaveException $e) {

            $this->_logger->error("Could not save product: " . $e->getMessage());
            return "Could not save product";

        }
    }

}