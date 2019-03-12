<?php declare(strict_types=1);

namespace Tests\Unit\AppBundle\Domain\Service;

use App\Application\Interfaces\CartWriterRepositoryInterface;
use App\Application\UseCase\AddItemToCartUseCase;
use Psr\Log\LoggerInterface;

class AddItemToCartUseCaseTest extends \PHPUnit\Framework\TestCase
{
    private const CART_ID_OK = 1;
    private const CART_ID_MISSING = 2;

    /* @var AddItemToCartUseCase */
    private $addItemToCartUseCase;

    public function testConstruct(): void
    {
        $this->assertInstanceOf(AddItemToCartUseCase::class, $this->addItemToCartUseCase);
    }

    public function testExecuteSuccess(): void
    {
        $this->addItemToCartUseCase->execute(self::CART_ID_OK, [2]);
        $this->assertTrue(true);
    }

    public function testExecuteError(): void
    {
        $this->addItemToCartUseCase->execute(self::CART_ID_MISSING, [2]);
        $this->assertTrue(true);
    }

    protected function setUp()
    {
        $repository = $this->createMock(CartWriterRepositoryInterface::class);
        $repository->expects($this->any())
            ->method('addProductToCart')
            ->willReturnCallback(
                function ($arg) {
                    if ($arg === self::CART_ID_MISSING) {
                        throw new \Exception();
                    }
                    return [1, 2, 3];
                }
            );

        $logger = $this->createMock(LoggerInterface::class);

        $this->addItemToCartUseCase = new AddItemToCartUseCase($repository, $logger);
    }
}
