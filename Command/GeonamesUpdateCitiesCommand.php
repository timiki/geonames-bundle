<?php

namespace Timiki\Bundle\GeonamesBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GeonamesUpdateCitiesCommand extends GeonamesCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('geonames:update:cities');
        $this->setDescription('Update Geonames cities list');
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface  $input  An InputInterface instance
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
        $population = $this->getContainer()->getParameter('geonames.cities_population');

        // Disable SQL logger
        $connection->getConfiguration()->setSQLLogger(null);

        $output->writeln('<info>> Start update Geonames list</info>');

        if (!in_array($population, [1000, 5000, 15000])) {
            $output->writeln('<error>False population value set in config "geonames.cities_population". Value must be one of 1000|5000|15000</error>');
        } else {
            $fileName = 'cities'.$population.'.zip';
            $file     = $this->download($output, 'http://download.geonames.org/export/dump/'.$fileName, $this->getTempDir('/'.$fileName));

            $output->writeln('Clear Geonames table');

            $connection->query('SET FOREIGN_KEY_CHECKS=0');
            $connection->executeUpdate($connection->getDatabasePlatform()->getTruncateTableSql('timiki_geonames'));
            $connection->query('SET FOREIGN_KEY_CHECKS=1');

            $output->writeln('Load new Geonames list to table...wait');

            $handler = fopen('zip://'.$file.'#cities'.$population.'.txt', 'r');

            // Output one line until end-of-file
            while (!feof($handler)) {
                $line    = fgets($handler);
                $explode = explode("\t", $line);
                if (count($explode) > 1) {
                    $connection->insert(
                        'timiki_geonames',
                        [
                            'geoname_id'        => array_key_exists(0, $explode) ? $explode[0] : null,
                            'name'              => array_key_exists(1, $explode) ? $explode[1] : null,
                            'ascii_name'        => array_key_exists(2, $explode) ? $explode[2] : null,
                            'alternate_names'   => array_key_exists(3, $explode) ? $explode[3] : null,
                            'latitude'          => array_key_exists(4, $explode) ? $explode[4] : null,
                            'longitude'         => array_key_exists(5, $explode) ? $explode[5] : null,
                            'feature_class'     => array_key_exists(6, $explode) ? $explode[6] : null,
                            'feature_code'      => array_key_exists(7, $explode) ? $explode[7] : null,
                            'country_code'      => array_key_exists(8, $explode) ? $explode[8] : null,
                            'cc2'               => array_key_exists(9, $explode) ? $explode[9] : null,
                            'admin1_code'       => array_key_exists(10, $explode) ? $explode[10] : null,
                            'admin2_code'       => array_key_exists(11, $explode) ? $explode[11] : null,
                            'admin3_code'       => array_key_exists(12, $explode) ? $explode[12] : null,
                            'admin4_code'       => array_key_exists(13, $explode) ? $explode[13] : null,
                            'population'        => array_key_exists(14, $explode) ? $explode[14] : 0,
                            'elevation'         => array_key_exists(15, $explode) ? $explode[15] : 0,
                            'dem'               => array_key_exists(16, $explode) ? $explode[16] : 0,
                            'timezone'          => array_key_exists(17, $explode) ? $explode[17] : null,
                            'modification_date' => array_key_exists(18, $explode) ? $explode[18] : null,
                        ]
                    );
                }
                unset($line);
                unset($explode);
            }

            fclose($handler);
            $em->flush();

            $output->writeln('Done!');

        }
    }
}