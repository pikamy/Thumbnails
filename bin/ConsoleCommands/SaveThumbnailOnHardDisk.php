<?php

declare(strict_types=1);

namespace Thumbnails\ConsoleCommands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thumbnails\ImagesManagement\Domain\Exceptions\ValidationProblem;
use Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnHardDisk\Handler;
use Thumbnails\ImagesManagement\Infrastructure\RepositoryAdapters\ThumbnailRepositoryBasedOnHardDisk;
use Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnHardDisk\CommandFactory;
use Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnHardDisk\SchemaValidator;

class SaveThumbnailOnHardDisk extends Command
{
    private SymfonyStyle $output;

    protected function configure(): void
    {
        $this->setDescription('Command for convert picture to thumbnail')
            ->addArgument('imagePath', InputArgument::REQUIRED, 'path to image')
            ->addArgument('height', InputArgument::REQUIRED, 'thumbnail height')
            ->addArgument('width', InputArgument::REQUIRED, 'thumbnail width')
            ->addArgument(
                'thumbnailPath',
                InputArgument::REQUIRED,
                'destination source path'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->output = new SymfonyStyle($input, $output);
        try {
            $this->output->writeln('Image conversion process has started');
            $schemaValidator = new SchemaValidator();
            $commandFactory = new CommandFactory($schemaValidator);
            $command = $commandFactory->build($input->getArguments());
            $handler = new Handler(new ThumbnailRepositoryBasedOnHardDisk());
            $handler->handle($command);
        } catch (ValidationProblem $exception) {
            $this->output->writeln('Image conversion to thumbnail failed');
            $this->output->error('Reason: ' . $exception->getMessage());

            return 1;
        }

        $this->output->success('Image conversion to thumbnail finished successfully!');

        return 0;
    }
}
