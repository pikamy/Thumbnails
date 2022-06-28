<?php

declare(strict_types=1);

namespace Thumbnails\ConsoleCommands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thumbnails\ImagesManagement\Domain\Exceptions\ValidationProblem;
use Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnCloud\Handler;
use Thumbnails\ImagesManagement\Infrastructure\RepositoryAdapters\ThumbnailRepositoryBasedOnCloud;
use Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnCloud\CommandFactory;
use Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnCloud\SchemaValidator;
use Thumbnails\ImagesManagement\Infrastructure\RepositoryAdapters\ThumbnailRepositoryBasedOnHardDisk;
use Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnCloud\Command as applicationCommand;

class SaveThumbnailOnCloud extends Command
{
    private SymfonyStyle $output;

    protected function configure(): void
    {
        $this->setDescription('Command for convert picture to thumbnail')
            ->addArgument('imagePath', InputArgument::REQUIRED, 'path to image')
            ->addArgument('height', InputArgument::REQUIRED, 'thumbnail height')
            ->addArgument('width', InputArgument::REQUIRED, 'thumbnail width')
            ->addArgument(
                'bucket',
                InputArgument::REQUIRED,
                'destination bucket'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->output = new SymfonyStyle($input, $output);
        $data = array_merge(['storageName' => $this->storage($input->getFirstArgument())], $input->getArguments());
        try {
            $this->output->writeln('Image conversion process has started');
            $command = $this->prepareCommand($data);
            $hardDiskRepository = new ThumbnailRepositoryBasedOnHardDisk();
            $handler = new Handler(new ThumbnailRepositoryBasedOnCloud($hardDiskRepository), $hardDiskRepository);
            $handler->handle($command);
        } catch (ValidationProblem $exception) {
            $this->output->writeln('Image conversion to thumbnail failed');
            $this->output->error('Reason: ' . $exception->getMessage());

            return 1;
        }

        $this->output->success('Image conversion to thumbnail finished successfully!');

        return 0;
    }

    private function prepareCommand(array $data): applicationCommand
    {
        $schemaValidator = new SchemaValidator();
        $commandFactory = new CommandFactory($schemaValidator);

        return $commandFactory->build($data);
    }

    private function storage(string $commandName): string
    {
        $commandName = explode(':', $commandName);
        return $commandName[1];
    }
}
