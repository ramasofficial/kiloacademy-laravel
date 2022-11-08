<?php

declare(strict_types=1);

namespace App\Services\Products\Readers;

use App\Services\Products\Collections\OfferCollection;
use App\Services\Products\Interfaces\OfferTransformerInterface;
use App\Services\Products\Interfaces\ReaderInterface;
use App\Services\Products\Transformers\OfferTransformer;
use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Psr\Log\LoggerInterface;

class ProductsApiReader implements ReaderInterface
{
    private string $url;

    public function __construct(
        private ClientInterface $client,
        private OfferTransformerInterface $offerTransformer,
        private LoggerInterface $logger
    ) {
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function read(): OfferCollection
    {
        try {
            $response = $this->client->request('GET', $this->url);
            $encodedContent = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Exception $exception) {
            $this->logger->error('CANNOT_READ_API', [
                'exception_message' => $exception->getMessage(),
                'exception_class' => get_class($exception),
            ]);

            throw $exception;
        }

        return $this->offerTransformer->transform($encodedContent);
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
