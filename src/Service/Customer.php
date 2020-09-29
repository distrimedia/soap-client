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

namespace DistriMedia\SoapClient\Service;

use DistriMedia\SoapClient\InvalidCustomerException;
use DistriMedia\SoapClient\InvalidOrderException;
use DistriMedia\SoapClient\Struct\Response\Inventory as InventoryResponse;

class Customer extends AbstractSoapClient
{
    const REQUEST_CHANGE_CUSTOMER_ACTION = 'ChangeCustomer';
    const REQUEST_CHANGE_CUSTOMER_ROOT = 'ChangeCustomer';

    public function changeCustomer(\DistriMedia\SoapClient\Struct\Customer $customer, string $orderId): ? bool
    {
        $data = [
            'OrderID' => $orderId,
            'Customer' => $customer->__toArray()
        ];

        $result = $this->execute(
            $data,
            self::REQUEST_CHANGE_CUSTOMER_ACTION,
            self::REQUEST_CHANGE_CUSTOMER_ROOT
        );

        $customerResponse = new \DistriMedia\SoapClient\Struct\Response\Customer($result);

        if ($customerResponse->getStatus() === self::STATUS_ERROR) {
            throw new InvalidCustomerException($customerResponse->getReason());
        }

        return true;
    }
}