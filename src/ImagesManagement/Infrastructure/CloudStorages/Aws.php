<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Infrastructure\CloudStorages;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Bucket;
use Thumbnails\ImagesManagement\Domain\ValueObjects\FullPath;
use Thumbnails\ImagesManagement\Domain\Exceptions\UploadProblem;

class Aws implements CloudStorage
{
    private S3Client $client;

    private function __construct(S3Client $client)
    {
        $this->client = $client;
    }

    public static function create(): Aws
    {
        return new self(new S3Client(\AWS_CFG));
    }

    public function client(): S3Client
    {
        return $this->client;
    }

    public function upload(FullPath $filePath, Bucket $bucket): void
    {
        try {
            $this->client->putObject([
                'Bucket' => $bucket,
                'Key'    => basename((string)$filePath),
                'Body'   => fopen((string)$filePath, 'r'),
                'ACL'    => 'public-read'
            ]);
        } catch (S3Exception $e) {
            throw UploadProblem::create();
        }
    }
}
