<?php

namespace Timiki\Bundle\GeonamesBundle;

use Symfony\Component\DependencyInjection\Container;

class Geonames
{

    /**
     * @var Container
     */
    private $container;

    /**
     * Create
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Get country
     *
     * @param string|integer $name Country name (geonameId|iso)
     * @param null|string $isoLanguage Country name by iso language
     * @return array|null
     */
    public function getCountry($name, $isoLanguage = null)
    {
        $countries = self::getCountries($isoLanguage);
        foreach ($countries as $country) {
            if (is_numeric($name)) {
                if ($country['geoname_id'] == $name) {
                    return $country;
                }
            } else {
                if ($country['iso'] == strtoupper($name)) {
                    return $country;
                } elseif (strtolower($country['country']) == strtolower($name)) {
                    return $country;
                }
            }
        }

        return null;
    }

    /**
     * Get countries list
     *
     * @param null|string $isoLanguage Countries names by iso language
     * @return array
     */
    public function getCountries($isoLanguage = null)
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em                       = $this->container->get('doctrine.orm.'.$this->container->getParameter('geonames.entity_manager'));
        $repositoryCountries      = $em->getRepository('GeonamesBundle:Countries');
        $repositoryAlternateNames = $em->getRepository('GeonamesBundle:AlternateNames');
        $qbCountries              = $repositoryCountries->createQueryBuilder('countries');
        $countries                = $qbCountries->where('countries.geonameid <> 0')->getQuery()->getArrayResult();

        if (empty($isoLanguage)) {
            return $countries;
        }

        foreach ($countries as $key => $country) {
            if ($altName = $repositoryAlternateNames->findOneBy(['geonameId' => $country['geoname_id'], 'isoLanguage' => strtoupper($isoLanguage)])) {
                $countries[$key]['country'] = $altName->getAlternateName();
            }
        }

        return $countries;
    }

    /**
     * Get city link
     *
     * @param integer $geonameId City geoname id
     * @return string|null
     */
    public function getCityLink($geonameId)
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em                       = $this->container->get('doctrine.orm.'.$this->container->getParameter('geonames.entity_manager'));
        $repositoryGeonames       = $em->getRepository('GeonamesBundle:Geonames');
        $repositoryAlternateNames = $em->getRepository('GeonamesBundle:AlternateNames');

        if ($city = $repositoryGeonames->findOneBy(['geonameId' => $geonameId])) {
            if ($link = $repositoryAlternateNames->findOneBy(['isoLanguage' => 'link', 'geonameId' => $city->getGeonameId()])) {
                return $link->getIsoLanguage();
            }
        }

        return null;
    }

    /**
     * Get city by geoname id
     *
     * @param integer $geonameId City geoname id
     * @param null|string $isoLanguage City name by iso language
     * @return array|null
     */
    public function getCityByGeonameId($geonameId, $isoLanguage = null)
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em                       = $this->container->get('doctrine.orm.'.$this->container->getParameter('geonames.entity_manager'));
        $repositoryGeonames       = $em->getRepository('GeonamesBundle:Geonames');
        $repositoryAlternateNames = $em->getRepository('GeonamesBundle:AlternateNames');

        if ($city = $repositoryGeonames->findOneBy(['geonameId' => $geonameId])) {
            $city = $city->toArray();
            if (empty($isoLanguage)) {
                return $city;
            }
            if ($alt = $repositoryAlternateNames->findOneBy(['geonameId' => $city['geoname_id'], 'isoLanguage' => $isoLanguage])) {
                $city['name'] = $alt->getAlternateName();
            }

            return $city;
        }

        return null;
    }

    /**
     * Get cities list by time zone
     *
     * @param string $timeZone Cities time zone
     * @param null|string $isoLanguage Cities names by iso language
     * @return array
     */
    public function getCitiesByTimeZone($timeZone, $isoLanguage = null)
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em                 = $this->container->get('doctrine.orm.'.$this->container->getParameter('geonames.entity_manager'));
        $repositoryGeonames = $em->getRepository('GeonamesBundle:Geonames');
        $qbGeonames         = $repositoryGeonames->createQueryBuilder('geonames');

        $qbGeonames->where('geonames.timezone = :timezone');
        $qbGeonames->setParameter('timezone', $timeZone);

        if (empty($isoLanguage)) {
            return $qbGeonames->getQuery()->getArrayResult();
        }

        // Slow! Use cache for this!
        $cities                   = $qbGeonames->getQuery()->getArrayResult();
        $repositoryAlternateNames = $em->getRepository('GeonamesBundle:AlternateNames');

        foreach ($cities as $key => $city) {
            if ($alt = $repositoryAlternateNames->findOneBy(['geonameId' => $city['geoname_id'], 'isoLanguage' => $isoLanguage])) {
                $cities[$key]['name'] = $alt->getAlternateName();
            }
        }

        return $cities;
    }

    /**
     * Get cities list by population
     *
     * @param null|integer $population Min cities population
     * @param null|string $isoLanguage Cities names by iso language
     * @return array
     */
    public function getCitiesByPopulation($population = 5000, $isoLanguage = null)
    {
        if (!is_numeric($population)) {
            $population = 5000;
        }

        /* @var $em \Doctrine\ORM\EntityManager */
        $em                 = $this->container->get('doctrine.orm.'.$this->container->getParameter('geonames.entity_manager'));
        $repositoryGeonames = $em->getRepository('GeonamesBundle:Geonames');
        $qbGeonames         = $repositoryGeonames->createQueryBuilder('geonames');

        $qbGeonames->where('geonames.population >= :population');
        $qbGeonames->setParameter('population', $population);

        if (empty($isoLanguage)) {
            return $qbGeonames->getQuery()->getArrayResult();
        }

        // Slow! Use cache for this!
        $cities                   = $qbGeonames->getQuery()->getArrayResult();
        $repositoryAlternateNames = $em->getRepository('GeonamesBundle:AlternateNames');

        foreach ($cities as $key => $city) {
            if ($alt = $repositoryAlternateNames->findOneBy(['geonameId' => $city['geoname_id'], 'isoLanguage' => $isoLanguage])) {
                $cities[$key]['name'] = $alt->getAlternateName();
            }
        }

        return $cities;
    }

    /**
     * Get cities list by country
     *
     * @param string|integer $country Cities country
     * @param null|integer $population Min cities population
     * @param null|string $isoLanguage Cities names by iso language
     * @return array
     */
    public function getCitiesByCountry($country, $population = 5000, $isoLanguage = null)
    {
        if (!$country = $this->getCountry($country)) {
            return [];
        }
        if (!is_numeric($population)) {
            $population = 5000;
        }

        /* @var $em \Doctrine\ORM\EntityManager */
        $em                 = $this->container->get('doctrine.orm.'.$this->container->getParameter('geonames.entity_manager'));
        $repositoryGeonames = $em->getRepository('GeonamesBundle:Geonames');
        $qbGeonames         = $repositoryGeonames->createQueryBuilder('geonames');

        $qbGeonames->where('geonames.countryCode = :countryCode');
        $qbGeonames->where('geonames.population >= :population');
        $qbGeonames->setParameter('countryCode', $country['iso']);
        $qbGeonames->setParameter('population', $population);

        if (empty($isoLanguage)) {
            return $qbGeonames->getQuery()->getArrayResult();
        }

        // Slow! Use cache for this!
        $cities                   = $qbGeonames->getQuery()->getArrayResult();
        $repositoryAlternateNames = $em->getRepository('GeonamesBundle:AlternateNames');

        foreach ($cities as $key => $city) {
            if ($alt = $repositoryAlternateNames->findOneBy(['geonameId' => $city['geoname_id'], 'isoLanguage' => $isoLanguage])) {
                $cities[$key]['name'] = $alt->getAlternateName();
            }
        }

        return $cities;
    }
}
