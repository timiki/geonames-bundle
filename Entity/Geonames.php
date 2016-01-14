<?php

namespace Timiki\Bundle\GeonamesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Geonames
 *
 * @ORM\Table(name="timiki_geonames", indexes={@ORM\Index(name="geoname_id", columns={"geoname_id"}), @ORM\Index(name="feature_class", columns={"feature_class"}), @ORM\Index(name="country_code", columns={"country_code"}), @ORM\Index(name="cc2", columns={"cc2"}), @ORM\Index(name="admin1_code", columns={"admin1_code"}), @ORM\Index(name="admin2_code", columns={"admin2_code"}), @ORM\Index(name="admin3_code", columns={"admin3_code"}), @ORM\Index(name="admin4_code", columns={"admin4_code"}), @ORM\Index(name="timezone", columns={"timezone"})})
 * @ORM\Entity
 */
class Geonames
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
     * @var integer
     *
     * @ORM\Column(name="geoname_id", type="integer", nullable=true)
     */
    private $geonameId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="ascii_name", type="string", length=200, nullable=true)
     */
    private $asciiName;

    /**
     * @var string
     *
     * @ORM\Column(name="alternate_names", type="text", nullable=true)
     */
    private $alternateNames;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="feature_class", type="string", length=1, nullable=true)
     */
    private $featureClass;

    /**
     * @var string
     *
     * @ORM\Column(name="feature_code", type="string", length=10, nullable=true)
     */
    private $featureCode;

    /**
     * @var string
     *
     * @ORM\Column(name="country_code", type="string", length=2, nullable=true)
     */
    private $countryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="cc2", type="string", length=200, nullable=true)
     */
    private $cc2;

    /**
     * @var string
     *
     * @ORM\Column(name="admin1_code", type="string", length=20, nullable=true)
     */
    private $admin1Code;

    /**
     * @var string
     *
     * @ORM\Column(name="admin2_code", type="string", length=80, nullable=true)
     */
    private $admin2Code;

    /**
     * @var string
     *
     * @ORM\Column(name="admin3_code", type="string", length=20, nullable=true)
     */
    private $admin3Code;

    /**
     * @var string
     *
     * @ORM\Column(name="admin4_code", type="string", length=20, nullable=true)
     */
    private $admin4Code;

    /**
     * @var integer
     *
     * @ORM\Column(name="population", type="bigint", nullable=true, options={"default": "0"})
     */
    private $population;

    /**
     * @var integer
     *
     * @ORM\Column(name="elevation", type="integer", nullable=true, options={"default": "0"})
     */
    private $elevation;

    /**
     * @var integer
     *
     * @ORM\Column(name="dem", type="integer", nullable=true, options={"default": "0"})
     */
    private $dem;

    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=40, nullable=true)
     */
    private $timezone;

    /**
     * @var string
     *
     * @ORM\Column(name="modification_date", type="string", length=255, nullable=true)
     */
    private $modificationDate;


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
     * Set geonameId
     *
     * @param integer $geonameId
     *
     * @return Geonames
     */
    public function setGeonameId($geonameId)
    {
        $this->geonameId = $geonameId;

        return $this;
    }

    /**
     * Get geonameId
     *
     * @return integer
     */
    public function getGeonameId()
    {
        return $this->geonameId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Geonames
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set asciiName
     *
     * @param string $asciiName
     *
     * @return Geonames
     */
    public function setAsciiName($asciiName)
    {
        $this->asciiName = $asciiName;

        return $this;
    }

    /**
     * Get asciiName
     *
     * @return string
     */
    public function getAsciiName()
    {
        return $this->asciiName;
    }

    /**
     * Set alternateNames
     *
     * @param string $alternateNames
     *
     * @return Geonames
     */
    public function setAlternateNames($alternateNames)
    {
        $this->alternateNames = $alternateNames;

        return $this;
    }

    /**
     * Get alternateNames
     *
     * @return string
     */
    public function getAlternateNames()
    {
        return $this->alternateNames;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Geonames
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Geonames
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set featureClass
     *
     * @param string $featureClass
     *
     * @return Geonames
     */
    public function setFeatureClass($featureClass)
    {
        $this->featureClass = $featureClass;

        return $this;
    }

    /**
     * Get featureClass
     *
     * @return string
     */
    public function getFeatureClass()
    {
        return $this->featureClass;
    }

    /**
     * Set featureCode
     *
     * @param string $featureCode
     *
     * @return Geonames
     */
    public function setFeatureCode($featureCode)
    {
        $this->featureCode = $featureCode;

        return $this;
    }

    /**
     * Get featureCode
     *
     * @return string
     */
    public function getFeatureCode()
    {
        return $this->featureCode;
    }

    /**
     * Set countryCode
     *
     * @param string $countryCode
     *
     * @return Geonames
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get countryCode
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Set cc2
     *
     * @param string $cc2
     *
     * @return Geonames
     */
    public function setCc2($cc2)
    {
        $this->cc2 = $cc2;

        return $this;
    }

    /**
     * Get cc2
     *
     * @return string
     */
    public function getCc2()
    {
        return $this->cc2;
    }

    /**
     * Set admin1Code
     *
     * @param string $admin1Code
     *
     * @return Geonames
     */
    public function setAdmin1Code($admin1Code)
    {
        $this->admin1Code = $admin1Code;

        return $this;
    }

    /**
     * Get admin1Code
     *
     * @return string
     */
    public function getAdmin1Code()
    {
        return $this->admin1Code;
    }

    /**
     * Set admin2Code
     *
     * @param string $admin2Code
     *
     * @return Geonames
     */
    public function setAdmin2Code($admin2Code)
    {
        $this->admin2Code = $admin2Code;

        return $this;
    }

    /**
     * Get admin2Code
     *
     * @return string
     */
    public function getAdmin2Code()
    {
        return $this->admin2Code;
    }

    /**
     * Set admin3Code
     *
     * @param string $admin3Code
     *
     * @return Geonames
     */
    public function setAdmin3Code($admin3Code)
    {
        $this->admin3Code = $admin3Code;

        return $this;
    }

    /**
     * Get admin3Code
     *
     * @return string
     */
    public function getAdmin3Code()
    {
        return $this->admin3Code;
    }

    /**
     * Set admin4Code
     *
     * @param string $admin4Code
     *
     * @return Geonames
     */
    public function setAdmin4Code($admin4Code)
    {
        $this->admin4Code = $admin4Code;

        return $this;
    }

    /**
     * Get admin4Code
     *
     * @return string
     */
    public function getAdmin4Code()
    {
        return $this->admin4Code;
    }

    /**
     * Set population
     *
     * @param integer $population
     *
     * @return Geonames
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
     * Set elevation
     *
     * @param integer $elevation
     *
     * @return Geonames
     */
    public function setElevation($elevation)
    {
        $this->elevation = $elevation;

        return $this;
    }

    /**
     * Get elevation
     *
     * @return integer
     */
    public function getElevation()
    {
        return $this->elevation;
    }

    /**
     * Set dem
     *
     * @param integer $dem
     *
     * @return Geonames
     */
    public function setDem($dem)
    {
        $this->dem = $dem;

        return $this;
    }

    /**
     * Get dem
     *
     * @return integer
     */
    public function getDem()
    {
        return $this->dem;
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     *
     * @return Geonames
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set modificationDate
     *
     * @param string $modificationDate
     *
     * @return Geonames
     */
    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;

        return $this;
    }

    /**
     * Get modificationDate
     *
     * @return string
     */
    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    /**
     * To Array
     */
    public function toArray()
    {
        return [
            'id'                => $this->getId(),
            'geoname_id'        => $this->getGeonameId(),
            'name'              => $this->getName(),
            'ascii_name'        => $this->getAsciiName(),
            'alternate_names'   => $this->getAlternateNames(),
            'latitude'          => $this->getLatitude(),
            'longitude'         => $this->getLongitude(),
            'feature_class'     => $this->getFeatureClass(),
            'feature_code'      => $this->getFeatureCode(),
            'country_code'      => $this->getCountryCode(),
            'cc2'               => $this->getCc2(),
            'admin1_code'       => $this->getAdmin1Code(),
            'admin2_code'       => $this->getAdmin2Code(),
            'admin3_code'       => $this->getAdmin3Code(),
            'admin4_code'       => $this->getAdmin4Code(),
            'population'        => $this->getPopulation(),
            'elevation'         => $this->getElevation(),
            'dem'               => $this->getDem(),
            'timezone'          => $this->getTimezone(),
            'modification_date' => $this->getModificationDate(),
        ];
    }
}

