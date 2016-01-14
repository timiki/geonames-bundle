<?php

namespace Timiki\Bundle\GeonamesBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GeonamesUpdateAlternateNamesCommand extends GeonamesCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('geonames:update:alternatenames');
        $this->setDescription('Update Geonames alternate names');
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

        // Disable SQL logger
        $connection->getConfiguration()->setSQLLogger(null);

        $output->writeln('<info>> Start update Geonames alternate names list</info>');

        $file = $this->download($output, 'http://download.geonames.org/export/dump/alternateNames.zip', $this->getTempDir('/alternateNames.zip'));

        $output->writeln('Clear Geonames alternate names table');

        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $connection->executeUpdate($connection->getDatabasePlatform()->getTruncateTableSql('timiki_geonames_alternate_names'));
        $connection->query('SET FOREIGN_KEY_CHECKS=1');

        $output->writeln('Load new Geonames alternate names list to table...wait');

        $handler = fopen('zip://'.$file.'#alternateNames.txt', 'r');

        // Output one line until end-of-file
        while (!feof($handler)) {
            $line    = fgets($handler);
            $explode = explode("\t", $line);
            if (count($explode) > 1) {

                $isoLanguage = array_key_exists(2, $explode) ? $explode[2] : null;
                $isHistoric  = array_key_exists(7, $explode) ? $explode[7] : null;
                $isShortName = array_key_exists(5, $explode) ? $explode[5] : null;

                // Not load not valid data
                if (!empty($isoLanguage) && $isoLanguage !== 'abbr' && $isHistoric !== 1 && $isShortName !== 1) {
                    $connection->insert(
                        'timiki_geonames_alternate_names',
                        [
                            'alternate_name_id' => array_key_exists(0, $explode) ? $explode[0] : null,
                            'geoname_id'        => array_key_exists(1, $explode) ? $explode[1] : null,
                            'iso_language'      => array_key_exists(2, $explode) ? $explode[2] : null,
                            'alternate_name'    => array_key_exists(3, $explode) ? $explode[3] : null,
                            'is_preferred_name' => array_key_exists(4, $explode) ? $explode[4] : null,
                            'is_short_name'     => array_key_exists(5, $explode) ? $explode[5] : null,
                            'is_colloquial'     => array_key_exists(6, $explode) ? $explode[6] : null,
                            'is_historic'       => array_key_exists(7, $explode) ? $explode[7] : null,
                        ]
                    );
                }
            }
        }

        fclose($handler);
        $em->flush();

        $output->writeln('Done!');
    }
}