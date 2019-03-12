<?php declare(strict_types=1);

namespace App\Infrastructure\Repository\Cart;

use App\Application\Interfaces\CartReaderRepositoryInterface;
use Memcached;
use Symfony\Component\Cache\Adapter\MemcachedAdapter;

class CartReaderRepository implements CartReaderRepositoryInterface
{
    /* @var Memcached */
    private $cache;

    /**
     * @param MemcachedAdapter $cache
     */
    public function __construct(MemcachedAdapter $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param int $cartId
     * @return array
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getCart(int $cartId): array
    {
        return $this->cache->get(self::CART . $cartId);
    }

    /**
     * @param int $cartId
     * @return array
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function findAllProductsFromCart(int $cartId): array
    {
        return $this->cache->get(self::CART . '_' . $cartId . '_' . self::PRODUCTS);
    }
}
