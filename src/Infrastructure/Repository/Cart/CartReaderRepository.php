<?php declare(strict_types=1);

namespace App\Infrastructure\Repository\Cart;

use App\Application\Interfaces\CartReaderRepositoryInterface;
use Predis\Connection\AbstractConnection;
use Symfony\Component\Cache\Adapter\RedisAdapter;


class CartReaderRepository implements CartReaderRepositoryInterface
{
    /* @var AbstractConnection */
    private $cache;

    /**
     * CartWriterRepository constructor.
     */
    public function __construct(string $host)
    {
        $this->cache = RedisAdapter::createConnection(
            $host
        );
    }

    /**
     * @param int $cartId
     * @return array
     */
    public function getCart(int $cartId): array
    {
        return $this->cache->get(self::CART . $cartId);
    }

    /**
     * @param int $cartId
     * @return array
     */
    public function findAllProductsFromCart(int $cartId): array
    {
        return $this->cache->get(self::CART . '_' . $cartId . '_' . self::PRODUCTS) ?? [];
    }
}
