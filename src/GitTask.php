<?php
namespace Samurai\Git;

use Samurai\Task\ITask;
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
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Initializing Git</info>');
        try{
            $this->getService('git')->status();
            $output->writeln('<info>Repository already initialized</info>');
            return ITask::NON_BLOCKING_ERROR_CODE;
        }catch(\Exception $e){
            $dirPath = $this->getService('project')->getDirectoryPath() ?: getcwd();
            $this->getService('git')->init($dirPath);
            return ITask::NO_ERROR_CODE;
        }
    }
}
