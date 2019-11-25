<?php

namespace App\Service;

use GuzzleHttp\Client;
use mysql_xdevapi\Exception;
use Symfony\Component\HttpFoundation\Request;

final class GetCompanySymbols
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $companyListApi;

    public function __construct(Client $client, string $companyListApi)
    {
        $this->client = $client;
        $this->companyListApi = $companyListApi;
    }

    public function get(): array
    {
        $companies = $this->getCompanyArray();

        array_walk($companies, function(&$item, $key) {
            $item = $item['Symbol'];
        });

        return $companies;
    }

    private function getCompanyArray(): array
    {
        try {
            $response = $this->client->request(Request::METHOD_GET, $this->companyListApi);

            $data = json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $data;
    }
}