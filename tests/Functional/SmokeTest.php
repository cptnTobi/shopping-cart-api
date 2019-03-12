<?php declare(strict_types=1);

namespace tests\Funcional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    /**
     *
     * @dataProvider urlProvider
     * @param        string $url
     * @param string $verb
     * @param        string $message
     */
    public function testPageIsSuccessful(string $verb, string $url, string $message): void
    {
        $client = self::createClient();
        $client->request($verb, $url);

        $this->assertTrue(
            $client->getResponse()->isSuccessful(),
            'Failed endpoint: ' . $message
        );
    }

    /**
     *
     * @return array
     */
    public function urlProvider(): array
    {
        return [
            ['GET', '/api/v1/cart/{cartId}/products', 'getProductsFromCart'],
            ['POST', '/api/v1/cart/{cartId}/product/{productId}', 'CitiesVenues'],
        ];
    }
}
