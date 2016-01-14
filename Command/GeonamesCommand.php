<?php

namespace Timiki\Bundle\GeonamesBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Helper\ProgressBar;

abstract class GeonamesCommand extends ContainerAwareCommand
{
    /**
     * Get temp dir path
     */
    protected function getTempDir($path = null)
    {
        $tempDir = $this->getContainer()->get('kernel')->getCacheDir().'/geonames';
        if (!is_dir($tempDir)) {
            mkdir($tempDir);
        }

        if ($path) {
            $tempDir .= $path;
        }

        return $tempDir;
    }

    /**
     * Download
     */
    protected function download(OutputInterface &$output, $from, $to)
    {
        $output->writeln('Download '.$from);
        $progress = new ProgressBar($output);
        $progress->setFormat('normal_nomax');
        $step     = 0;
        $ctx      = stream_context_create(
            array(),
            array(
                'notification' => function ($notification_code, $severity, $message, $message_code, $bytes_transferred, $bytes_max) use ($output, $progress, &$step) {
                    switch ($notification_code) {
                        case STREAM_NOTIFY_FILE_SIZE_IS:
                            $progress->start(100);
                            break;
                        case STREAM_NOTIFY_PROGRESS:
                            $newStep = round(($bytes_transferred / $bytes_max) * 100);
                            if ($newStep > $step) {
                                $step = $newStep;
                                $progress->setProgress($step);
                            }
                            break;
                    }
                },
            )
        );

        $file = file_get_contents($from, false, $ctx);
        $progress->finish();
        file_put_contents($to, $file);
        $output->writeln('');

        return $to;
    }
}