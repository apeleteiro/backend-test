

namespace App\Tests\Api;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

class ApiTest extends TestCase
{
    public function testStats()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://backend-test.peleteiro.eu/api/stats');

        $code = json_decode($response->getContent(), true)['code'];

        $this->assertEquals(200, $code);
    }

    public function testUsers()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://backend-test.peleteiro.eu/api/users');

        $code = json_decode($response->getContent(), true)['code'];

        $this->assertEquals(200, $code);
    }
}
