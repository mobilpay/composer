<?php

namespace Netopia\Payment;

/**
 * Class Invoice
 *
 * @copyright NETOPIA
 * @author    Claudiu Tudose
 * @version   1.0
 */
class Split
{
    /**
     * class-specific errors
     *
     * @var integer
     */
    const ERROR_INVALID_PARAMETER = 0x11110001;
    const ERROR_INVALID_INTERVAL_DAY = 0x11110002;
    const ERROR_INVALID_PAYMENTS_NO = 0x11110003;
    const ERROR_LOAD_FROM_XML_CURRENCY_ATTR_MISSING = 0x31110001;

    /**
     * Defines the values for destinations
     *
     * @var integer
     */
    public $destinations = null;

    // public function __construct(?\DOMNode $elem = null)
    // {
    //     if($elem != null) {
    //         $this->loadFromXml($elem);
    //     }
    // }

    // /**
    //  * Populate the class from the request xml
    //  *
    //  * @param  DOMNode $elem
    //  * @throws Exception On missing xml attributes
    //  */
    // protected function loadFromXml(DOMNode $elem)
    // {
    //     $this->destinations = array();
    //     $elems = $elem->getElementsByTagName('destination');
    //     if ($elems->length > 1) {
    //         foreach ($elems as $split) {
    //             $data = array();
    //             $attr = $split->attributes->getNamedItem('id');
    //             if (is_null($attr)) {
    //                 throw new Exception('Mobilpay_Payment_Recurrence::loadFromXml failed; split id attribute missing', self::ERROR_LOAD_FROM_XML_CURRENCY_ATTR_MISSING);
    //             }
    //             $data['id'] = $attr->value;
    //             $attr = $split->attributes->getNamedItem('amount');
    //             if (is_null($attr)) {
    //                 throw new Exception('Mobilpay_Payment_Recurrence::loadFromXml failed; split amount attribute missing', self::ERROR_LOAD_FROM_XML_CURRENCY_ATTR_MISSING);
    //             }
    //             $data['amount'] = $attr->value;
    //             $this->destinations[] = $data;
    //         }
    //     }
    //     return;
    // }


    // /**
    //  * Returns the xml representation for this object. Appends the representation if $xmlDoc is provided
    //  *
    //  * @param  DOMDocument $xmlDoc
    //  * @return DOMElement
    //  * @throws Exception On invalid data
    //  */
    // public function createXmlElement(DOMDocument $xmlDoc)
    // {
    //     if (!($xmlDoc instanceof DOMDocument)) {
    //         throw new Exception('', self::ERROR_INVALID_PARAMETER);
    //     }
    //     $retElems = array();
    //     foreach ($this->destinations as $details) {
    //         $xmlInvElem = $xmlDoc->createElement('destination');
    
    //         $xmlAttr = $xmlDoc->createAttribute('id');
    //         $xmlAttr->nodeValue = $details['id'];
    //         $xmlInvElem->appendChild($xmlAttr);
    
    //         $xmlAttr = $xmlDoc->createAttribute('amount');
    //         $xmlAttr->nodeValue = $details['amount'];
    //         $xmlInvElem->appendChild($xmlAttr);
    //         $retElems[] = $xmlInvElem;
    //     }
    //     return $retElems;
    // }
}