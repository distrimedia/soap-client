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
 * @category  Baldwin
 * @package  DistriMediaClient
 * @author      Tristan Hofman <info@baldwin.be>
 * @copyright Copyright (c) 2020 Baldwin BV (https://www.baldwin.be)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
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

namespace DistriMedia\SoapClient\Struct;

use DistriMedia\SoapClient\Traits\ArgumentValidatorTrait;

class ValueAddedHandlingItem extends AbstractStruct implements StructInterface
{
    use ArgumentValidatorTrait;

    const VALUE_ADDED_HANDLING_ITEM = 'ValueAddedHandlingItem';
    const CODE = 'Code';
    const DESCRIPTION = 'Description';
    const INSTRUCTION = 'Instruction';

    private $code;

    private $description;

    private $instruction;

    /**
     * Unique code for VAH
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Unique code for VAH
     * @param string $code
     * @return ValueAddedHandlingItem
     */
    public function setCode(string $code)
    {
        self::validateLength(self::CODE, $code, 20);
        $this->code = $code;
        return $this;
    }

    /**
     * Description of VAH. This Description will be shown to pick-employee when picking order
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Description of VAH. This Description will be shown to pick-employee when picking order
     * @param string $description
     * @return ValueAddedHandlingItem
     */
    public function setDescription(string $description)
    {
        self::validateLength(self::DESCRIPTION, $description, 60);

        $this->description = $description;
        return $this;
    }

    /**
     * Instruction related to Order or Orderline. This instruction is saved per Order/Line and used for extra
     * information related to the description.
     * @return string|null
     */
    public function getInstruction()
    {
        return $this->instruction;
    }

    /**
     * Instruction related to Order or Orderline. This instruction is saved per Order/Line and used for extra
     * information related to the description.
     * @param string $instruction
     * @return ValueAddedHandlingItem
     */
    public function setInstruction(string $instruction)
    {
        self::validateLength(self::DESCRIPTION, $instruction, 400);

        $this->instruction = $instruction;
        return $this;
    }

    /**
     * @return array
     */
    public function __toArray(): array
    {
        $this->validate();

        $data = [
            self::CODE => $this->getCode(),
            self::DESCRIPTION => $this->getDescription(),
            self::INSTRUCTION => $this->getInstruction()
        ];

        $data = array_filter($data);

        return $data;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        return true;
    }
}
