<?php declare(strict_types=1);

namespace App\Application\Interfaces;

interface CartReaderRepositoryInterface extends BaseRepositoryInterface
{
    public function getCart(int $cartId): array;

    public function findAllProductsFromCart(int $cartId): array;
}
