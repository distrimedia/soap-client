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

namespace DistriMedia\SoapClient\Struct\Response;

class AbstractResponse
{
    const STATUS = 'Status';
    const STATUS_ERROR = 'Error';
    const REASON = 'Reason';
    const RESPONSE_DATE = 'ResponseDate';
    const RESPONSE_TIME = 'ResponseTime';

    protected $status;
    protected $reason;
    protected $responseDate;
    protected $responseTime;

    public function __construct(array $data = [])
    {
        $this->status = isset($data[self::STATUS]) ? $data[self::STATUS] : null;
        $this->reason = isset($data[self::REASON]) ? $data[self::REASON] : null;
        $this->responseDate = isset($data[self::RESPONSE_DATE]) ? $data[self::RESPONSE_DATE] : null;
        $this->responseTime = isset($data[self::RESPONSE_TIME]) ? $data[self::RESPONSE_TIME] : null;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return mixed
     */
    public function getResponseDate()
    {
        return $this->responseDate;
    }

    /**
     * @return mixed
     */
    public function getResponseTime()
    {
        return $this->responseTime;
    }

    public function getData()
    {
        return get_object_vars($this);
    }
}
