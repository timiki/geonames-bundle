<?php

namespace Timiki\Bundle\GeonamesBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GeonamesUpdateCountriesCommand extends GeonamesCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('geonames:update:countries');
        $this->setDescription('Update Geonames countries list');
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface $input An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code
     *
     * @throws \LogicException When this abstract method is not implemented
     *
     * @see setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em         = $this->getContainer()->get('doctrine.orm.'.$this->getContainer()->getParameter('geonames.entity_manager'));
        $connection = $em->getConnection();

        // Disable SQL logger
        $connection->getConfiguration()->setSQLLogger(null);

        $output->writeln('<info>> Start update Geonames countries list</info>');
        $file = $this->download($output, 'http://download.geonames.org/export/dump/countryInfo.txt', $this->getTempDir('/countryInfo.txt'));

        $output->writeln('Clear Geonames countries table');

        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $connection->executeUpdate($connection->getDatabasePlatform()->getTruncateTableSql('timiki_geonames_countries'));
        $connection->query('SET FOREIGN_KEY_CHECKS=1');

        $output->writeln('Load new Geonames countries list to countries table...wait');

        $startLine   = 50;
        $currentLine = 0;

        $handler = fopen($file, 'r');
        // Output one line until end-of-file
        while (!feof($handler)) {
            $line = fgets($handler);
            if ($currentLine > $startLine) {
                $explode = explode("\t", $line);
                if (count($explode) > 1 && !empty($explode[3]) && !empty($explode[5])) {
                    $connection->insert(
                        'timiki_geonames_countries',
                        [
                            'iso'                  => array_key_exists(0, $explode) ? $explode[0] : null,
                            'iso3'                 => array_key_exists(1, $explode) ? $explode[1] : null,
                            'iso_numeric'          => array_key_exists(2, $explode) ? $explode[2] : null,
                            'fips'                 => array_key_exists(3, $explode) ? $explode[3] : null,
                            'country'              => array_key_exists(4, $explode) ? $explode[4] : null,
                            'capital'              => array_key_exists(5, $explode) ? $explode[5] : null,
                            'area'                 => array_key_exists(6, $explode) ? $explode[6] : null,
                            'population'           => array_key_exists(7, $explode) ? $explode[7] : null,
                            'continent'            => array_key_exists(8, $explode) ? $explode[8] : null,
                            'tld'                  => array_key_exists(9, $explode) ? $explode[9] : null,
                            'currency_code'        => array_key_exists(10, $explode) ? $explode[10] : null,
                            'currency_name'        => array_key_exists(11, $explode) ? $explode[11] : null,
                            'phone'                => array_key_exists(12, $explode) ? $explode[12] : null,
                            'postal_code_format'   => array_key_exists(13, $explode) ? $explode[13] : null,
                            'postal_code_regex'    => array_key_exists(14, $explode) ? $explode[14] : null,
                            'languages'            => array_key_exists(15, $explode) ? $explode[15] : [],
                            'geoname_id'           => array_key_exists(16, $explode) ? $explode[16] : null,
                            'neighbours'           => array_key_exists(17, $explode) ? $explode[17] : [],
                            'equivalent_fips_code' => array_key_exists(18, $explode) ? $explode[18] : null,
                        ]
                    );
                }
            }
            $currentLine++;
        }

        fclose($handler);
        $em->flush();

        $output->writeln('Done!');
    }
}