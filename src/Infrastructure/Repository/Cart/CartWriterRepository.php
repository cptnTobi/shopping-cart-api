<?php declare(strict_types=1);

namespace App\Infrastructure\Repository\Cart;

use App\Application\Interfaces\CartWriterRepositoryInterface;
use Memcached;
use Symfony\Component\Cache\Adapter\MemcachedAdapter;

class CartWriterRepository implements CartWriterRepositoryInterface
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
     * @param array $products
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function addProductToCart(int $cartId, array $products): void
    {
        $oldProducts = [];

        try {
            $oldProducts = $this->cache->get(self::CART . '_' . $cartId . '_' . self::PRODUCTS);
        } catch (\Exception $e) {
        }

        $this->cache->set(
            self::CART . '_' . $cartId . '_' . self::PRODUCTS,
            array_merge($oldProducts, $products)
        );
    }
}
