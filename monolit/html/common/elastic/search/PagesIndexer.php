<?php

namespace common\elastic\search;

use common\models\Pages;
use common\models\search\Pages as PagesIndex;
use Elasticsearch\ClientBuilder;

class PagesIndexer
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @inheritDoc
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function clear()
    {
        $this->client->deleteByQuery([
            'index' => PagesIndex::index(),
            'type' => PagesIndex::type(),
            'body' => [
                'query' => [
                    'match_all' => new \stdClass(),
                ],
            ],
        ]);
    }

    public function index(Pages $page)
    {

        $this->client->index([
            'index' => PagesIndex::index(),
            'type' => PagesIndex::type(),
            'id' => $page->id,
            'body' => [
                'page_id' => $page->id,
                'status' => $page->status,
                'slug' => $page->slug,
            ]
        ]);
    }

    public function remove(Pages $page)
    {
        $this->client->delete([
            'index' => PagesIndex::index(),
            'type' => PagesIndex::type(),
            'id' => $page->id,
        ]);
    }
}