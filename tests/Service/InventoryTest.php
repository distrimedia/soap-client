<?php
/**
 *
 *
 *  NOTICE OF LICENSE
 *
 *  This source file is subject to the Open Software License (OSL 3.0)
 *  that is provided with Magento in the file LICENSE.txt.
 *  It is also available through the world-wide-web at this URL:
 *  http://opensource.org/licenses/osl-3.0.php
 *
 *  DISCLAIMER
 *
 *  Do not edit or add to this file if you wish to upgrade the DistriMediaClient plugin
 *  to newer versions in the future. If you wish to customize the plugin for your
 *  needs please document your changes and make backups before your update.
 *
 *  @category  Baldwin
 *  @package  DistriMediaClient
 *  @author      Tristan Hofman <info@baldwin.be>
 *  @copyright Copyright (c) 2020 Baldwin BV (https://www.baldwin.be)
 *  @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 *  INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
 *  PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 *  HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
 *  ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 *  WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 */

declare(strict_types=1);

namespace DistriMedia\SoapClientTest\Service;

use DistriMedia\SoapClient\InvalidCustomerException;
use DistriMedia\SoapClient\Service\Inventory as InventoryService;
use DistriMedia\SoapClient\Struct\Customer;

class InventoryTest extends TestCase
{
    /**
     * @return InventoryService
     */
    private function createInventoryService(): InventoryService
    {
        $uri = $_ENV['API_URI'] ?: '';
        $webshopCode = $_ENV['WEBSHOP_CODE'] ?: '';
        $password = $_ENV['API_PASSWORD'] ?: '';

        $orderService = new InventoryService($uri, $webshopCode, $password);

        return $orderService;
    }

    /**
     * @covers ::OrderService
     */
    public function testCreateService()
    {
        $inventorService = $this->createInventoryService();

        self::assertInstanceOf(\DistriMedia\SoapClient\Service\Inventory::class, $inventorService);
    }

    /**
     * @covers ::OrderService
     */
    public function testFetchAllInventory()
    {
        $inventorService = $this->createInventoryService();

        $result = $inventorService->fetchTotalInventory();

        self::assertInstanceOf(\DistriMedia\SoapClient\Struct\Response\Inventory::class, $result);
    }
}
