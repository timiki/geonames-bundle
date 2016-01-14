<?php

namespace Timiki\Bundle\GeonamesBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GeonamesUpdateCommand extends GeonamesCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('geonames:update');
        $this->setDescription('Update Geonames');
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
        $output->writeln('<info>> Start update Geonames</info>');

        $commandUpdateCountries      = $this->getApplication()->find('geonames:update:countries');
        $commandUpdateCities         = $this->getApplication()->find('geonames:update:cities');
        $commandUpdateAlternateNames = $this->getApplication()->find('geonames:update:alternatenames');

        $commandUpdateCountries->run($input, $output);
        $commandUpdateCities->run($input, $output);
        $commandUpdateAlternateNames->run($input, $output);
    }
}