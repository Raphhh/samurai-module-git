<?php
namespace Samurai\Git;

use Pimple\Container;
use Samurai\Project\Project;
use Samurai\Task\ITask;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * Class GitTaskTest
 * @package Samurai\Git
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class GitTaskTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testExecute()
    {
        $git = $this->getMockBuilder('PHPGit\Git')->disableOriginalConstructor()->getMock();

        $git->expects($this->at(0))
            ->method('__call')
            ->with('status', [])
            ->will($this->throwException(new \Exception()));

        $git->expects($this->at(1))
            ->method('__call', ['path' => 'dir/path'])
            ->with('init');

        $input = new ArrayInput([]);
        $output = new BufferedOutput();

        $services = new Container();

        $services['project'] = function(){
            $project = new Project();
            $project->setDirectoryPath('dir/path');
            return $project;
        };

        $services['git'] = function() use($git){
            return $git;
        };

        $task = new GitTask($services);
        $this->assertSame(ITask::NO_ERROR_CODE, $task->execute($input, $output));
        $this->assertSame("Initializing Git\n", $output->fetch());
    }
}
