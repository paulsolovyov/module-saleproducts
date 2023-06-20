<?php

/**
 * Copyright © 2023 All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace PaulSolovyov\SaleProducts\Model;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class GetSaleProductsManagement implements \PaulSolovyov\SaleProducts\Api\GetSaleProductsManagementInterface
{
    /**
     * Product instance
     *
     * @var mixed CollectionFactory
     */
    private $_productCollectionFactory;

    public function __construct(
        CollectionFactory $_productCollectionFactory
    ) {
        $this->_productCollectionFactory = $_productCollectionFactory;
    }


    
    /**
     * Gets list of products that are on sale today.
     *
     * @return array[string]
     */
    public function getGetSaleProducts()
    {
        $collection = $this->_productCollectionFactory->create();

        $currentDate = date("Y/m/d");

        // Get specific attributes instead of * (all)
        $collection
            ->addFieldToSelect('id')
            ->addFieldToSelect('sku')
            ->addFieldToSelect('name')
            ->addFieldToSelect('price')
            ->addFieldToSelect('special_price')
            ->addFieldToSelect('special_to_date')
            ->addFieldToSelect('special_from_date')
            ->addFieldToSelect('status');

        // Filter for Enabled Status
        $collection->addAttributeToFilter('status', array('eq' => 1));

        // Get product with Special TO Date bigger than current date
        $collection->addAttributeToFilter('special_to_date', array('gt' => $currentDate));

        $jsonResponse = array();

        foreach($collection as $product)
        {
            $productData = [
                'id' => $product->getId(),
                'sku' => $product->getSku(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'special_price' => $product->getSpecialPrice(),
                'special_to_date' => $product->getSpecialToDate(),
                'special_from_date' => $product->getSpecialFromDate(),
            ];

            $jsonResponse[] = $productData;
        }

        return $jsonResponse; 
    }
}
