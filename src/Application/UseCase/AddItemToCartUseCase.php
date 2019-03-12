<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Interfaces\CartWriterRepositoryInterface;
use Exception;
use Psr\Log\LoggerInterface;

class AddItemToCartUseCase
{
    private $cartWriterRepository;
    private $logger;

    public function __construct(
        CartWriterRepositoryInterface $cartWriterRepository,
        LoggerInterface $logger
    )
    {
        $this->cartWriterRepository = $cartWriterRepository;
        $this->logger = $logger;
    }

    /**
     * @param int $cartId
     * @param array $products
     */
    public function execute(int $cartId, array $products): void
    {
        try {
            $this->cartWriterRepository->addProductToCart($cartId, $products);
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
        }
    }
}
