<?php
namespace Samurai\Git;

use Samurai\Task\Task;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GitCommand
 * @package Samurai\Git
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class GitTask extends Task
{
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return bool
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Initializing Git</info>');
        return true;
    }
}
