<?php

declare(strict_types=1);

namespace PaulSolovyov\SaleProducts\Api;

interface GetSaleProductsManagementInterface
{
    /**
     * GET for GetSaleProducts api
     * @return array<int<0, max>, array<string, mixed>>
     */
    public function getGetSaleProducts();
}

