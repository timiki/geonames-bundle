# Geonames bundle

## Installation

1. Install the bundle using composer:

    composer require timiki/geonames-bundle:*

or add to composer.json

    {
        require: {
            "timiki/geonames-bundle": "*"
        }
    }

2. Add the bundle to your AppKernel.php:

    $bundles = array(
        // ...
        new Timiki\Bundle\GeonamesBundle\GeonamesBundle(),
        // ...
    );

3. Install database schema:

    console doctrine:schema:update --force

    or

    console doctrine:schema:update --dump-sql

4. Load Geonames data:

    console geonames:update


## Update data

For update Geonames data run next command:

    console geonames:update
