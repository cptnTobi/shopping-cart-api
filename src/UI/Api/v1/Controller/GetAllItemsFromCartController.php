<?php declare(strict_types=1);

namespace App\UI\Api\v1\Controller;

use App\Application\Exception\DataNotFoundException;
use App\Application\UseCase\GetAllItemsFromCartUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetAllItemsFromCartController
{
    private $getAllItemsFromCart;

    public function __construct(GetAllItemsFromCartUseCase $getAllItemsFromCart)
    {
        $this->getAllItemsFromCart = $getAllItemsFromCart;
    }

    /**
     *
     * @Route("/api/v1/cart/{cartId}/products", methods={"GET"})
     * @param int $cartId
     * @return JsonResponse
     * @throws \Exception
     */
    public function getProductsFromCartAction(int $cartId): JsonResponse
    {
        try {
            $products = $this->getAllItemsFromCart->execute($cartId);
        } catch (DataNotFoundException $exception) {
            return new JsonResponse([], JsonResponse::HTTP_BAD_REQUEST);
        }

        if (empty($products)) {
            return new JsonResponse([], JsonResponse::HTTP_NO_CONTENT);
        }

        return new JsonResponse($products);
    }
}
