<?php declare(strict_types=1);

namespace Tests\Unit\AppBundle\Domain\Service;

use App\Application\Interfaces\CartReaderRepositoryInterface;
use App\Application\UseCase\GetAllItemsFromCartUseCase;
use Psr\Log\LoggerInterface;

class GetAllItemsFromCartUseCaseTest extends \PHPUnit\Framework\TestCase
{
    private const CART_ID_OK = 1;
    private const CART_ID_MISSING = 2;

    /* @var GetAllItemsFromCartUseCase */
    private $getAllItemsFromCartUseCase;

    public function testConstruct(): void
    {
        $this->assertInstanceOf(GetAllItemsFromCartUseCase::class, $this->getAllItemsFromCartUseCase);
    }

    public function testExecuteSuccess(): void
    {
        $this->assertNotEmpty($this->getAllItemsFromCartUseCase->execute(self::CART_ID_OK));
    }

    /**
     * @expectedException \App\Application\Exception\DataNotFoundException
     */
    public function testExecuteWithFailure(): void
    {
        $this->getAllItemsFromCartUseCase->execute(self::CART_ID_MISSING);
    }

    protected function setUp()
    {
        $repository = $this->createMock(CartReaderRepositoryInterface::class);
        $repository->expects($this->any())
            ->method('findAllProductsFromCart')
            ->willReturnCallback(
                function ($arg) {
                    if ($arg === self::CART_ID_MISSING) {
                        throw new \Exception();
                    }
                    return [1, 2, 3];
                }
            );

        $logger = $this->createMock(LoggerInterface::class);

        $this->getAllItemsFromCartUseCase = new GetAllItemsFromCartUseCase($repository, $logger);
    }
}
