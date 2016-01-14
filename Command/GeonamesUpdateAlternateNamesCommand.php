<?php

namespace Timiki\Bundle\GeonamesBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

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
        $quote      = function ($value) use ($connection) {
            return $connection->quote($value);
        };

        // Disable SQL logger
        $connection->getConfiguration()->setSQLLogger(null);

        $output->writeln('<info>> Start update Geonames alternate names list</info>');

        $file = $this->download($output, 'http://download.geonames.org/export/dump/alternateNames.zip', $this->getTempDir('/alternateNames.zip'));

        $output->writeln('Clear Geonames alternate names table');

        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $connection->executeUpdate($connection->getDatabasePlatform()->getTruncateTableSql('timiki_geonames_alternate_names'));
        $connection->query('SET FOREIGN_KEY_CHECKS=1');

        $output->writeln('Load new Geonames alternate names list to table...wait');
        $output->writeln('Processing downloaded data...');

        // Prepare
        $handler = fopen('zip://'.$file.'#alternateNames.txt', 'r');
        $count   = 0;
        while (!feof($handler)) {
            fgets($handler);
            $count++;
        }

        // rewind
        fclose($handler);
        $handler = fopen('zip://'.$file.'#alternateNames.txt', 'r');

        $progress = new ProgressBar($output);
        $progress->setFormat('normal_nomax');
        $step = 0;
        $sql  = '';

        $progress->start($count);
        // Output one line until end-of-file
        while (!feof($handler)) {
            $step++;
            $line    = fgets($handler);
            $explode = explode("\t", $line);
            if (count($explode) > 1) {

                $isoLanguage = array_key_exists(2, $explode) ? $explode[2] : null;
                $isHistoric  = array_key_exists(7, $explode) ? $explode[7] : null;
                $isShortName = array_key_exists(5, $explode) ? $explode[5] : null;

                // Not load not valid data
                if (!empty($isoLanguage) && $isoLanguage !== 'link' && $isoLanguage !== 'post' && $isoLanguage !== 'iata' && $isoLanguage !== 'icao' && $isoLanguage !== 'faac' && $isoLanguage !== 'fr_1793' && $isoLanguage !== 'abbr' && $isHistoric !== 1 && $isShortName !== 1) {
                    $sql .= $connection->createQueryBuilder()->insert('timiki_geonames_alternate_names')->values(
                            [
                                'alternate_name_id' => $quote(array_key_exists(0, $explode) ? $explode[0] : null),
                                'geoname_id'        => $quote(array_key_exists(1, $explode) ? $explode[1] : null),
                                'iso_language'      => $quote(array_key_exists(2, $explode) ? $explode[2] : null),
                                'alternate_name'    => $quote(array_key_exists(3, $explode) ? $explode[3] : null),
                                'is_preferred_name' => $quote(array_key_exists(4, $explode) ? $explode[4] : null),
                                'is_short_name'     => $quote(array_key_exists(5, $explode) ? $explode[5] : null),
                                'is_colloquial'     => $quote(array_key_exists(6, $explode) ? $explode[6] : null),
                                'is_historic'       => $quote(array_key_exists(7, $explode) ? $explode[7] : null),
                            ]
                        )->getSQL().';';
                    if (($step % 1000) === 0) {
                        $progress->setProgress($step);
                        $connection->exec($sql);
                        $sql = '';
                    }
                }
            }
        }

        $progress->setProgress($step);
        $connection->exec($sql);
        fclose($handler);

        $output->writeln('');
        $output->writeln('Done!');
    }
}