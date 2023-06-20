<?php

namespace PaulSolovyov\SaleProducts\Api;

interface ProductInterface
{

    /**
     * Sets product Name to "ON SALE!!!" + Product Name
     *
     * @param integer $id
     * @return string
     */
    public function setSaleProductTitle(int $id);
}