<?php declare(strict_types=1);

namespace App\Infrastructure\Repository\Cart;

use App\Application\Interfaces\CartReaderRepositoryInterface;

class CartReaderRepository implements CartReaderRepositoryInterface
{
    private $cache;

    /**
     * CartWriterRepository constructor.
     */
    public function __construct(string $host)
    {
        $this->cache = new \Predis\Client([
            'scheme' => 'tcp',
            'host' => 'redis',
            'port' => 6379,
        ]);
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
        return json_decode($this->cache->get(self::CART . '_' . $cartId . '_' . self::PRODUCTS)) ?? [];
    }
}
