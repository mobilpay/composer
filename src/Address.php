<?php

namespace Netopia\Payment;


/**
 * Class Address
 * @copyright NETOPIA
 * @author Claudiu Tudose
 * @version 1.0
 * 
 */
class Address
{
    const TYPE_COMPANY = 'company';
    const TYPE_PERSON = 'person';
    
    const ERROR_INVALID_PARAMETER = 0x11100001;
    const ERROR_INVALID_ADDRESS_TYPE = 0x11100002;
    const ERROR_INVALID_ADDRESS_TYPE_VALUE = 0x11100003;
    
    public $type = null;
    public $firstName = null;
    public $lastName = null;
    public $country = null;
    public $county = null;
    public $city = null;
    public $address = null;
    public $zipCode = null;
    public $email = null;
    public $mobilePhone = null;

    public function __construct (\DOMNode $elem = null)
    {

        if ($elem != null)
        {
            $this->loadFromXml($elem);
        }
    }

    protected function loadFromXml (\DOMNode $elem)
    {

        $attr = $elem->attributes->getNamedItem('type');
        if ($attr != null)
        {
            $this->type = $attr->nodeValue;
        } else
        {
            $this->type = self::TYPE_PERSON;
        }
        $elems = $elem->getElementsByTagName('first_name');
        if ($elems->length == 1)
        {
            $this->firstName = urldecode($elems->item(0)->nodeValue);
        }
        $elems = $elem->getElementsByTagName('last_name');
        if ($elems->length == 1)
        {
            $this->lastName = urldecode($elems->item(0)->nodeValue);
        }
        /**
         * country, county, city and zip_code 
         * will be concatenate to the address
         */
        $country = $elem->getElementsByTagName('country');
        if ($country->length == 1)
        {
            $this->country = urldecode($elems->item(0)->nodeValue);
        }
        $county = $elem->getElementsByTagName('county');
        if ($county->length == 1)
        {
            $this->county = urldecode($elems->item(0)->nodeValue);
        }
        $city = $elem->getElementsByTagName('city');
        if ($city->length == 1)
        {
            $this->city = urldecode($elems->item(0)->nodeValue);
        }
        $zip_code = $elem->getElementsByTagName('zip_code');
        if ($zip_code->length == 1)
        {
            $this->zipCode = urldecode($elems->item(0)->nodeValue);
        }
        $elems = $elem->getElementsByTagName('address');
        if ($elems->length == 1)
        {
            $this->address .= ($this->country) ? $this->country.', ' : '';
            $this->address .= ($this->county) ? $this->county.', ' : '';
            $this->address .= ($this->city) ? $this->city.', ' : '';
            $this->address .= urldecode($elems->item(0)->nodeValue);
            $this->address .= ($this->zipCode) ? ', '.$this->zipCode : '';
        }

        $elems = $elem->getElementsByTagName('email');
        if ($elems->length == 1)
        {
            $this->email = urldecode($elems->item(0)->nodeValue);
        }
        $elems = $elem->getElementsByTagName('mobile_phone');
        if ($elems->length == 1)
        {
            $this->mobilePhone = urldecode($elems->item(0)->nodeValue);
        }
    }

    public function createXmlElement (\DOMDocument $xmlDoc, $nodeName)
    {

        if (! ($xmlDoc instanceof \DOMDocument))
        {
            throw new \Exception('', self::ERROR_INVALID_PARAMETER);
        }
        
        $addrElem = $xmlDoc->createElement($nodeName);
        
        if ($this->type == null)
        {
            throw new \Exception('Invalid address type', self::ERROR_INVALID_ADDRESS_TYPE);
        } elseif ($this->type != self::TYPE_COMPANY && $this->type != self::TYPE_PERSON)
        {
            throw new \Exception('Invalid address type', self::ERROR_INVALID_ADDRESS_TYPE_VALUE);
        }
        
        $xmlAttr = $xmlDoc->createAttribute('type');
        $xmlAttr->nodeValue = $this->type;
        $addrElem->appendChild($xmlAttr);
        
        if ($this->firstName != null)
        {
            $xmlElem = $xmlDoc->createElement('first_name');
            $xmlElem->appendChild($xmlDoc->createCDATASection(urlencode($this->firstName)));
            $addrElem->appendChild($xmlElem);
        }
        
        if ($this->lastName != null)
        {
            $xmlElem = $xmlDoc->createElement('last_name');
            $xmlElem->appendChild($xmlDoc->createCDATASection(urlencode($this->lastName)));
            $addrElem->appendChild($xmlElem);
        }
        
        if ($this->address != null)
        {
            $xmlElem = $xmlDoc->createElement('address');
            $xmlElem->appendChild($xmlDoc->createCDATASection(urlencode($this->address)));
            $addrElem->appendChild($xmlElem);
        }
        
        if ($this->email != null)
        {
            $xmlElem = $xmlDoc->createElement('email');
            $xmlElem->appendChild($xmlDoc->createCDATASection(urlencode($this->email)));
            $addrElem->appendChild($xmlElem);
        }
        
        if ($this->mobilePhone != null)
        {
            $xmlElem = $xmlDoc->createElement('mobile_phone');
            $xmlElem->appendChild($xmlDoc->createCDATASection(urlencode($this->mobilePhone)));
            $addrElem->appendChild($xmlElem);
        }
        
        return $addrElem;
    }

    public function toArray ()
    {

        return array(
            'ppiFirstName' => $this->firstName , 
            'ppiLastName' => $this->lastName , 
            'ppiAddress' => $this->address , 
            'ppiEmail' => $this->email , 
            'ppiPhone' => $this->mobilePhone);
    }
}
