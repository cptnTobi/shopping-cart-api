<?php declare(strict_types=1);

namespace App\Infrastructure\Repository\Cart;

use App\Application\Interfaces\CartWriterRepositoryInterface;
use Predis\Client;

class CartWriterRepository implements CartWriterRepositoryInterface
{
    /* @var Client */
    private $cache;

    /**
     * CartWriterRepository constructor.
     * @param string $host
     */
    public function __construct(string $host)
    {
        $this->cache = $this->cache = new Client([
            'scheme' => 'tcp',
            'host' => 'redis',
            'port' => 6379,
        ]);;
    }

    /**
     * @param int $cartId
     * @param array $products
     */
    public function addProductToCart(int $cartId, array $products): void
    {
        $oldProducts = [];

        try {
            $oldProducts = json_decode($this->cache->get(self::CART . '_' . $cartId . '_' . self::PRODUCTS)) ?? [];
        } catch (\Exception $e) {
        }
        try {
            $this->cache->set(
                self::CART . '_' . $cartId . '_' . self::PRODUCTS,
                json_encode(array_merge($oldProducts, $products))
            );
        } catch (\Exception $e) {
            echo $e->getMessage();
        }


    }
}
