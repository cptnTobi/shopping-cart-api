<?php declare(strict_types=1);

namespace App\Infrastructure\Repository\Cart;

use App\Application\Interfaces\CartWriterRepositoryInterface;
use Predis\Connection\AbstractConnection;
use Symfony\Component\Cache\Adapter\RedisAdapter;

class CartWriterRepository implements CartWriterRepositoryInterface
{
    /* @var AbstractConnection */
    private $cache;

    /**
     * CartWriterRepository constructor.
     */
    public function __construct()
    {
        $this->cache = RedisAdapter::createConnection(
            'redis://redis'
        );
    }

    /**
     * @param int $cartId
     * @param array $products
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
