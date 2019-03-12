<?php declare(strict_types=1);

namespace App\Application\Interfaces;

interface CartWriterRepositoryInterface extends BaseRepositoryInterface
{
    public function addProductToCart(int $cartId, array $products): void;
}
