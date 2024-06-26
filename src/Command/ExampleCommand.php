<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'ExampleCommand',
    description: 'Add a short description for your command',
)]
class ExampleCommand extends Command
{
    protected static $defaultName = 'app:example-command';

    protected function configure()
    {
        $this
            ->setDescription('Example command to perform a specific task')
            ->setHelp('This command demonstrates how to create and use a Symfony console command.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Logic to perform the specific task
        $output->writeln('Executing ExampleCommand...');

        // Example task: Output a message
        $output->writeln('This is an example task performed by the command.');

        // You can add your actual business logic here, such as generating a report or processing data

        return Command::SUCCESS;
    }
}
