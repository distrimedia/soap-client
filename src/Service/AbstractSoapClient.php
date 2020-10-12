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
 * @category Baldwin
 * @package  DistriMediaClient
 * @author   Tristan Hofman <info@baldwin.be>
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

namespace DistriMedia\SoapClient\Service;

use DistriMedia\SoapClient\InvalidXmlResponseException;
use Psr\Log\LoggerInterface;
use Spatie\ArrayToXml\ArrayToXml;

/**
 * Class AbstractSoapClient
 * @package DistriMedia\SoapClient\Service
 */
abstract class AbstractSoapClient
{
    const WEBSHOP_CODE = 'WebshopCode';
    const SOAP_PASSWORD = 'SoapPassword';
    const STATUS_ERROR = 'Error';
    const SOAP_BODY = 'soapBody';
    const SOAP_REQUEST_RESULT = 'SoapRequestResult';

    const VALID_ACTION_NAMES = [
        'CreateOrder',
        'ChangeOrderStatus',
        'ChangeCustomer',
        'RequestOrderStatus',
        'CreateProducts',
        'RequestInventory',
        'CreatePreAdvice',
        'ChangePreAdviceStatus',
        'RequestPreAdviceStatus'
    ];

    /**
     * @var string
     */
    private $uri;

    /**
     * Soap requests without this Tag will not be processed, and the connection will be broken by the SOAP
     * server. This is also the case if UniuqeWebshopID is not known within the eWMS system.
     * @var string
     */
    private $uniqueWebshopID;

    /**
     * In case the web shops server doesn’t have a static IP address that can be whitelisted by Distrimedia
     * to get access to the API of Distrimedia, you may add (optional) field SoapPassword and fill out the
     * password provided by distrimedia,which will also grant access to the API
     * @var
     */
    private $soapPassword;

    /**
     * AbstractSoapClient constructor.
     * @param string $uri
     */
    public function __construct(
        string $uri,
        string $uniqueWebshopID,
        string $soapPassword,
        LoggerInterface $logger = null
    )
    {
        $this->logger = $logger;
        $this->uri = $uri;
        $this->uniqueWebshopID = $uniqueWebshopID;
        $this->soapPassword = $soapPassword;
    }

    /**
     * @param array $body
     * @param string $rootElement
     * @param string $action
     * @return array
     */
    protected function execute(array $body, string $action, string $rootElement = ''): array
    {
        $document = $this->convertDataToXmlDocument($body, $rootElement);
        if (!empty($rootElement)) {
            $rootNode = $document->getElementsByTagName($rootElement)->item(0);
        } else {
            $rootNode = $document->getElementsByTagName('root')->item(0)->childNodes;
        }

        $envelope = $this->generateEnvelope($rootNode);

        $result = $this->__sendRequest($envelope, $action);

        return $result;
    }

    /**
     * @param $envelope
     * @return array
     */
    private function __sendRequest($envelope, $action)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->uri);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $envelope);

        $headers = [
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: {$action}"
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $soapResponse = curl_exec($ch);
        if (is_string($soapResponse)) {
            $result = $this::parseSoapResponseToArray($soapResponse);
        } else {
            $error = curl_error($ch);
            throw new InvalidXmlResponseException("Soap call failed! {$error}");
        }

        if (!isset($result[self::SOAP_BODY])) {
            throw new InvalidXmlResponseException("Invalid SOAP response received");
        }

        if (!isset($result[self::SOAP_BODY][self::SOAP_REQUEST_RESULT])) {
            throw new InvalidXmlResponseException("Invalid SOAP response received");
        }

        if ($this->logger instanceof LoggerInterface) {
            $responseXml = ArrayToXml::convert($result[self::SOAP_BODY], self::SOAP_REQUEST_RESULT);
            $this->logger->critical("request: " . $envelope  . "\nresponse: ". $responseXml);
        }

        return $result[self::SOAP_BODY][self::SOAP_REQUEST_RESULT];
    }

    private static function parseSoapResponseToArray(string $soapResponse): array
    {
        $responseArray = [];

        // SimpleXML seems to have problems with the colon ":" in the <xxx:yyy> response tags, so take them out
        $soapResponse = preg_replace("/(<\/?)(\w+):([^>]*>)/", '$1$2$3', $soapResponse);

        if (!empty($soapResponse)) {
            $xml = simplexml_load_string($soapResponse);
            $json = json_encode($xml);
            $responseArray = json_decode($json, true);
        }

        return $responseArray;
    }

    /**
     * We're adding the credentials to make the API call
     */
    private function addCredentialsDocument(\DOMElement $body): void
    {
        $body->appendChild(new \DOMElement(self::WEBSHOP_CODE, $this->uniqueWebshopID));
        $body->appendChild(new \DOMElement(self::SOAP_PASSWORD, $this->soapPassword));
    }

    /**
     * @param array $data
     * @return \DOMDocument
     */
    private function convertDataToXmlDocument(array $data, string $rootElement = ''): \DOMDocument
    {
        $arrayToXmlObject = new ArrayToXml($data, $rootElement);

        $document = $arrayToXmlObject->toDom();

        return $document;
    }

    /**
     * @param \DOMNode $bodyNode
     * @return false|string
     */
    private function generateEnvelope($bodyNode)
    {
        $envelope = <<<EOD
<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xmlns:xsd="http://www.w3.org/2001/XMLSchema"
xmlns:ns1="{$this->uri}"
xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
</soap:Envelope>
EOD;
        $dom = new \DOMDocument();
        $dom->loadXML($envelope);
        $body = $dom->createElement('soap:Body');

        if ($bodyNode instanceof \DOMNode) {
            $bodyImportNode = $dom->importNode($bodyNode, true);
            $body->appendChild($bodyImportNode);
        } elseif ($bodyNode instanceof \DOMNodeList) {
            foreach ($bodyNode as $node) {
                $bodyImportNode = $dom->importNode($node, true);
                $body->appendChild($bodyImportNode);
            }
        }

        $this->addCredentialsDocument($body);
        $dom->documentElement->appendChild($body);
        return $dom->saveXML();
    }
}
