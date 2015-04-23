<?php
namespace Samurai\Git;

use Pimple\Container;
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
        $input = new ArrayInput([]);
        $output = new BufferedOutput();

        $services = new Container();
        $task = new GitTask($services);
        $this->assertTrue($task->execute($input, $output));
        $this->assertSame("Initializing Git\n", $output->fetch());
    }
}
