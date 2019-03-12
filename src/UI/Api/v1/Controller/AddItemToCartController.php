<?php declare(strict_types=1);

namespace App\UI\Api\v1\Controller;

use App\Application\UseCase\AddItemToCartUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AddItemToCartController
{
    private $addItemToCartUseCase;

    /**
     * AddItemToCartController constructor.
     * @param AddItemToCartUseCase $addItemToCartUseCase
     */
    public function __construct(AddItemToCartUseCase $addItemToCartUseCase)
    {
        $this->addItemToCartUseCase = $addItemToCartUseCase;
    }

    /**
     *
     * @Route("/api/v1/cart/{cartId}/product/{productId}", methods={"POST"})
     * @param int $cartId
     * @param int $productId
     * @return JsonResponse
     * @throws \Exception
     */
    public function addItemsToCartAction(int $cartId, int $productId): JsonResponse
    {
        $this->addItemToCartUseCase->execute($cartId, [$productId]);

        return new JsonResponse();
    }
}
