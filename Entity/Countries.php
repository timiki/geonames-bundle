<?php

namespace Timiki\Bundle\GeonamesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Countries
 *
 * @ORM\Table(name="timiki_geonames_countries", indexes={@ORM\Index(name="iso", columns={"iso"}), @ORM\Index(name="iso3", columns={"iso3"}), @ORM\Index(name="iso_numeric", columns={"iso_numeric"}), @ORM\Index(name="geoname_id", columns={"geoname_id"})})
 * @ORM\Entity
 */
class Countries
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="iso", type="string", length=255, nullable=true)
     */
    private $iso;

    /**
     * @var string
     *
     * @ORM\Column(name="iso3", type="string", length=255, nullable=true)
     */
    private $iso3;

    /**
     * @var string
     *
     * @ORM\Column(name="iso_numeric", type="string", length=255, nullable=true)
     */
    private $isoNumeric;

    /**
     * @var string
     *
     * @ORM\Column(name="fips", type="string", length=255, nullable=true)
     */
    private $fips;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="capital", type="string", length=255, nullable=true)
     */
    private $capital;

    /**
     * @var string
     *
     * @ORM\Column(name="area", type="bigint", nullable=true)
     */
    private $area;

    /**
     * @var integer
     *
     * @ORM\Column(name="population", type="bigint", nullable=true)
     */
    private $population;

    /**
     * @var string
     *
     * @ORM\Column(name="continent", type="string", length=255, nullable=true)
     */
    private $continent;

    /**
     * @var string
     *
     * @ORM\Column(name="tld", type="string", length=255, nullable=true)
     */
    private $tld;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_code", type="string", length=255, nullable=true)
     */
    private $currencyCode;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_name", type="string", length=255, nullable=true)
     */
    private $currencyName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code_format", type="string", length=255, nullable=true)
     */
    private $postalCodeFormat;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code_regex", type="string", length=255, nullable=true)
     */
    private $postalCodeRegex;

    /**
     * @var array
     *
     * @ORM\Column(name="languages", type="json_array", nullable=true)
     */
    private $languages;

    /**
     * @var integer
     *
     * @ORM\Column(name="geoname_id", type="integer", nullable=true)
     */
    private $geonameid;

    /**
     * @var array
     *
     * @ORM\Column(name="neighbours", type="json_array", nullable=true)
     */
    private $neighbours;

    /**
     * @var string
     *
     * @ORM\Column(name="equivalent_fips_code", type="string", length=255, nullable=true)
     */
    private $equivalentFipsCode;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set iso
     *
     * @param string $iso
     *
     * @return Countries
     */
    public function setIso($iso)
    {
        $this->iso = $iso;

        return $this;
    }

    /**
     * Get iso
     *
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * Set iso3
     *
     * @param string $iso3
     *
     * @return Countries
     */
    public function setIso3($iso3)
    {
        $this->iso3 = $iso3;

        return $this;
    }

    /**
     * Get iso3
     *
     * @return string
     */
    public function getIso3()
    {
        return $this->iso3;
    }

    /**
     * Set isoNumeric
     *
     * @param string $isoNumeric
     *
     * @return Countries
     */
    public function setIsoNumeric($isoNumeric)
    {
        $this->isoNumeric = $isoNumeric;

        return $this;
    }

    /**
     * Get isoNumeric
     *
     * @return string
     */
    public function getIsoNumeric()
    {
        return $this->isoNumeric;
    }

    /**
     * Set fips
     *
     * @param string $fips
     *
     * @return Countries
     */
    public function setFips($fips)
    {
        $this->fips = $fips;

        return $this;
    }

    /**
     * Get fips
     *
     * @return string
     */
    public function getFips()
    {
        return $this->fips;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Countries
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set capital
     *
     * @param string $capital
     *
     * @return Countries
     */
    public function setCapital($capital)
    {
        $this->capital = $capital;

        return $this;
    }

    /**
     * Get capital
     *
     * @return string
     */
    public function getCapital()
    {
        return $this->capital;
    }

    /**
     * Set area
     *
     * @param string $area
     *
     * @return Countries
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set population
     *
     * @param integer $population
     *
     * @return Countries
     */
    public function setPopulation($population)
    {
        $this->population = $population;

        return $this;
    }

    /**
     * Get population
     *
     * @return integer
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * Set continent
     *
     * @param string $continent
     *
     * @return Countries
     */
    public function setContinent($continent)
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * Get continent
     *
     * @return string
     */
    public function getContinent()
    {
        return $this->continent;
    }

    /**
     * Set tld
     *
     * @param string $tld
     *
     * @return Countries
     */
    public function setTld($tld)
    {
        $this->tld = $tld;

        return $this;
    }

    /**
     * Get tld
     *
     * @return string
     */
    public function getTld()
    {
        return $this->tld;
    }

    /**
     * Set currencyCode
     *
     * @param string $currencyCode
     *
     * @return Countries
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * Get currencyCode
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Set currencyName
     *
     * @param string $currencyName
     *
     * @return Countries
     */
    public function setCurrencyName($currencyName)
    {
        $this->currencyName = $currencyName;

        return $this;
    }

    /**
     * Get currencyName
     *
     * @return string
     */
    public function getCurrencyName()
    {
        return $this->currencyName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Countries
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set postalCodeFormat
     *
     * @param string $postalCodeFormat
     *
     * @return Countries
     */
    public function setPostalCodeFormat($postalCodeFormat)
    {
        $this->postalCodeFormat = $postalCodeFormat;

        return $this;
    }

    /**
     * Get postalCodeFormat
     *
     * @return string
     */
    public function getPostalCodeFormat()
    {
        return $this->postalCodeFormat;
    }

    /**
     * Set postalCodeRegex
     *
     * @param string $postalCodeRegex
     *
     * @return Countries
     */
    public function setPostalCodeRegex($postalCodeRegex)
    {
        $this->postalCodeRegex = $postalCodeRegex;

        return $this;
    }

    /**
     * Get postalCodeRegex
     *
     * @return string
     */
    public function getPostalCodeRegex()
    {
        return $this->postalCodeRegex;
    }

    /**
     * Set languages
     *
     * @param array $languages
     *
     * @return Countries
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages
     *
     * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Set geonameid
     *
     * @param integer $geonameid
     *
     * @return Countries
     */
    public function setGeonameid($geonameid)
    {
        $this->geonameid = $geonameid;

        return $this;
    }

    /**
     * Get geonameid
     *
     * @return integer
     */
    public function getGeonameid()
    {
        return $this->geonameid;
    }

    /**
     * Set neighbours
     *
     * @param array $neighbours
     *
     * @return Countries
     */
    public function setNeighbours($neighbours)
    {
        $this->neighbours = $neighbours;

        return $this;
    }

    /**
     * Get neighbours
     *
     * @return array
     */
    public function getNeighbours()
    {
        return $this->neighbours;
    }

    /**
     * Set equivalentFipsCode
     *
     * @param string $equivalentFipsCode
     *
     * @return Countries
     */
    public function setEquivalentFipsCode($equivalentFipsCode)
    {
        $this->equivalentFipsCode = $equivalentFipsCode;

        return $this;
    }

    /**
     * Get equivalentFipsCode
     *
     * @return string
     */
    public function getEquivalentFipsCode()
    {
        return $this->equivalentFipsCode;
    }

    /**
     * To Array
     */
    public function toArray()
    {
        return [
            'id'                   => $this->getId(),
            'iso'                  => $this->getIso(),
            'iso3'                 => $this->getIso3(),
            'iso_numeric'          => $this->getIsoNumeric(),
            'fips'                 => $this->getFips(),
            'country'              => $this->getCountry(),
            'capital'              => $this->getCapital(),
            'area'                 => $this->getArea(),
            'population'           => $this->getPopulation(),
            'continent'            => $this->getContinent(),
            'tld'                  => $this->getTld(),
            'currency_code'        => $this->getCurrencyCode(),
            'currency_name'        => $this->getCurrencyName(),
            'phone'                => $this->getPhone(),
            'postal_code_format'   => $this->getPostalCodeFormat(),
            'postal_code_regex'    => $this->getPostalCodeRegex(),
            'languages'            => $this->getLanguages(),
            'geoname_id'           => $this->getGeonameid(),
            'neighbours'           => $this->getNeighbours(),
            'equivalent_fips_code' => $this->getEquivalentFipsCode(),
        ];
    }
}

