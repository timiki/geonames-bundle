# Geonames bundle

## Installation

**Install the bundle using composer:**


    composer require timiki/geonames-bundle:*

or add to composer.json

    {
        require: {
            "timiki/geonames-bundle": "*"
        }
    }

**Add the bundle to your AppKernel.php:**


    $bundles = array(
        // ...
        new Timiki\Bundle\GeonamesBundle\GeonamesBundle(),
        // ...
    );

**Install or update database schema:**


    console doctrine:schema:update --force

    or

    console doctrine:schema:update --dump-sql

**Load Geonames data:**


    console geonames:update

## Update data

For update Geonames data run next command:


    console geonames:update

