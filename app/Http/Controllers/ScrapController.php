<?php

namespace App\Http\Controllers;

use App\Services\Scraping\Collection\AdCollection;
use App\Services\Scraping\DTO\Ad;
use DOMElement;
use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Config\Repository;
use Symfony\Component\DomCrawler\Crawler;

class ScrapController extends Controller
{
    public const PROXIES_LIST = [];

    public function __construct(
        private readonly ClientInterface $client,
        private readonly Repository $config
    ) {
    }

    /**
     * @throws GuzzleException
     */
    public function __invoke()
    {
        $adCollection = new AdCollection();

        $page = 1;
        while (true) {
            try {
                $this->parseAds($adCollection, $page);

                if ($page === 24) {
                    break;
                }

                $page++;
            } catch (Exception $exception) {
                echo $exception->getMessage();
                break;
            }
        }

        dd($adCollection);
    }

    /**
     * @throws GuzzleException
     */
    private function parseAds(AdCollection $adCollection, int $page): void
    {
        if ($page === 1) {
            $page = '';
        }

        $request = $this->client->request('POST', $this->config->get('scraping.parse_url'), [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
                'Content-type' => 'application/json',
            ],
            'json' => [
                'url' => $this->config->get('scraping.page_url') . $page,
            ],
        ]);

        $crawler = new Crawler($request->getBody()->getContents());

        $ads = $crawler->filter('.simpleAds');

        $this->processAds($ads, $adCollection);
    }

    private function processAds(Crawler $ads, AdCollection $adCollection): void
    {
        /** @var DOMElement $ad */
        foreach ($ads as $ad) {
            $crawler = new Crawler($ad);

            try {
                $title = $crawler->filter('.itemReview h3 a')->text();
                $description = $crawler->filter('.itemReview .adsTextReview')->text();
                $price = $crawler->filter('.itemReview .adsPrice span')->text();
                $photo = $crawler->filter('.adsImage img')->image()->getUri();
            } catch (Exception $exception) {
                $title = $title ?? '';
                $description = $description ?? '';
                $price = $price ?? '';
                $photo = $photo ?? '';
            }

            $adCollection->add(
                new Ad($title, $description, $price, $photo)
            );
        }
    }
}
