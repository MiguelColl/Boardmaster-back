<?php

namespace App\Services;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Database\Eloquent\Model;

class Elasticsearch
{
    private \Elastic\Elasticsearch\Client $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts(config('services.elastic.hosts'))
            ->build();
    }

    public function insert(Model $model)
    {
        $this->client->index([
            'index' => $model->getTable(),
            'type' => '_doc',
            'id' => $model->getKey(),
            'body' => $model->toElastic(),
        ]);
    }

    public function delete(Model $model)
    {
        $this->client->delete([
            'index' => $model->getTable(),
            'type' => '_doc',
            'id' => $model->getKey(),
        ]);
    }

    public function search(string $query, int $page, Model $model)
    {
        return $this->client->search([
            'index' => $model->getTable(),
            'type' => '_search',
            'body' => [
                'from' => ($page - 1) * config('constants.pagination'),
                'size' => config('constants.pagination'),
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['name', 'brand'],
                        // 'fuzziness' => 2,
                        'type' => 'phrase_prefix',
                    ],
                ],
            ],
        ]);
    }
}
