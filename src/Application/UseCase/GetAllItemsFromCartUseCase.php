<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\Exception\DataNotFoundException;
use App\Application\Interfaces\CartReaderRepositoryInterface;
use Exception;
use Psr\Log\LoggerInterface;

class GetAllItemsFromCartUseCase
{
    private $cartReaderRepository;
    private $logger;

    public function __construct(
        CartReaderRepositoryInterface $cartReaderRepository,
        LoggerInterface $logger
    )
    {
        $this->cartReaderRepository = $cartReaderRepository;
        $this->logger = $logger;
    }

    /**
     * @param int $cartId
     * @return array
     * @throws Exception
     */
    public function execute(int $cartId): array
    {
        try {
            return $this->cartReaderRepository->findAllProductsFromCart($cartId);
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw new DataNotFoundException('Cart not found.');
        }
    }
}
