<?php

namespace Timiki\Bundle\GeonamesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlternateNames
 *
 * @ORM\Table(name="timiki_geonames_alternate_names", indexes={@ORM\Index(name="alternate_name_id", columns={"alternate_name_id"}), @ORM\Index(name="geoname_id", columns={"geoname_id"}), @ORM\Index(name="iso_language", columns={"iso_language"}), @ORM\Index(name="is_preferred_name", columns={"is_preferred_name"}), @ORM\Index(name="is_short_name", columns={"is_short_name"}), @ORM\Index(name="is_colloquial", columns={"is_colloquial"}), @ORM\Index(name="is_historic", columns={"is_historic"})})
 * @ORM\Entity
 */
class AlternateNames
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
     * @ORM\Column(name="alternate_name_id", type="integer")
     */
    private $alternateNameId;

    /**
     * @var integer
     *
     * @ORM\Column(name="geoname_id", type="integer")
     */
    private $geonameId;

    /**
     * @var string
     *
     * @ORM\Column(name="iso_language", type="string", length=7, nullable=true)
     */
    private $isoLanguage;

    /**
     * @var string
     *
     * @ORM\Column(name="alternate_name", type="string", length=200, nullable=true)
     */
    private $alternateName;

    /**
     * @var string
     *
     * @ORM\Column(name="is_preferred_name", type="string", length=1, nullable=true)
     */
    private $isPreferredName;

    /**
     * @var string
     *
     * @ORM\Column(name="is_short_name", type="string", length=1, nullable=true)
     */
    private $isShortName;

    /**
     * @var string
     *
     * @ORM\Column(name="is_colloquial", type="string", length=1, nullable=true)
     */
    private $isColloquial;

    /**
     * @var string
     *
     * @ORM\Column(name="is_historic", type="string", length=1, nullable=true)
     */
    private $isHistoric;

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
     * Set alternateNameId
     *
     * @param integer $alternateNameId
     *
     * @return AlternateNames
     */
    public function setAlternateNameId($alternateNameId)
    {
        $this->alternateNameId = $alternateNameId;

        return $this;
    }

    /**
     * Get alternateNameId
     *
     * @return integer
     */
    public function getAlternateNameId()
    {
        return $this->alternateNameId;
    }

    /**
     * Set geonameId
     *
     * @param integer $geonameId
     *
     * @return AlternateNames
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
     * Set isoLanguage
     *
     * @param string $isoLanguage
     *
     * @return AlternateNames
     */
    public function setIsoLanguage($isoLanguage)
    {
        $this->isoLanguage = $isoLanguage;

        return $this;
    }

    /**
     * Get isoLanguage
     *
     * @return string
     */
    public function getIsoLanguage()
    {
        return $this->isoLanguage;
    }

    /**
     * Set alternateName
     *
     * @param string $alternateName
     *
     * @return AlternateNames
     */
    public function setAlternateName($alternateName)
    {
        $this->alternateName = $alternateName;

        return $this;
    }

    /**
     * Get alternateName
     *
     * @return string
     */
    public function getAlternateName()
    {
        return $this->alternateName;
    }

    /**
     * Set isPreferredName
     *
     * @param string $isPreferredName
     *
     * @return AlternateNames
     */
    public function setIsPreferredName($isPreferredName)
    {
        $this->isPreferredName = $isPreferredName;

        return $this;
    }

    /**
     * Get isPreferredName
     *
     * @return string
     */
    public function getIsPreferredName()
    {
        return $this->isPreferredName;
    }

    /**
     * Set isShortName
     *
     * @param string $isShortName
     *
     * @return AlternateNames
     */
    public function setIsShortName($isShortName)
    {
        $this->isShortName = $isShortName;

        return $this;
    }

    /**
     * Get isShortName
     *
     * @return string
     */
    public function getIsShortName()
    {
        return $this->isShortName;
    }

    /**
     * Set isColloquial
     *
     * @param string $isColloquial
     *
     * @return AlternateNames
     */
    public function setIsColloquial($isColloquial)
    {
        $this->isColloquial = $isColloquial;

        return $this;
    }

    /**
     * Get isColloquial
     *
     * @return string
     */
    public function getIsColloquial()
    {
        return $this->isColloquial;
    }

    /**
     * Set isHistoric
     *
     * @param string $isHistoric
     *
     * @return AlternateNames
     */
    public function setIsHistoric($isHistoric)
    {
        $this->isHistoric = $isHistoric;

        return $this;
    }

    /**
     * Get isHistoric
     *
     * @return string
     */
    public function getIsHistoric()
    {
        return $this->isHistoric;
    }

    /**
     * To Array
     */
    public function toArray()
    {
        return [
            'id'                => $this->getId(),
            'alternate_name_id' => $this->getAlternateNameId(),
            'geoname_id'        => $this->getGeonameId(),
            'iso_language'      => $this->getIsoLanguage(),
            'alternate_name'    => $this->getAlternateName(),
            'is_preferred_name' => $this->getIsPreferredName(),
            'is_short_name'     => $this->getIsShortName(),
            'is_colloquial'     => $this->getIsColloquial(),
            'is_historic'       => $this->getIsHistoric(),
        ];
    }
}

