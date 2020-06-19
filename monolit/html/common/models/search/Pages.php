<?php

namespace common\models\search;

use yii\elasticsearch\ActiveRecord;
use yii\helpers\Url;

/**
 * Class Products
 * @package console\models
 * @property integer $product_id
 * @property string $name
 * @property string $name_alias
 * @property string $description
 * @property string $image
 * @property string $url
 */
class Pages extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return ['page_id', 'status', 'slug'];
    }

    /**
     * @return array
     */
    public static function mapping()
    {
        return [
            'properties' => [
                'page_id' => ['type' => 'keyword'],
                'status' => ['type' => 'keyword'],
                'slug' => [
                    'type' => 'text',
                    'analyzer' => 'autocomplete',
                    'search_analyzer' => 'standard',
                ],
            ]
        ];
    }

    /**
     * Set (update) mappings for this model
     */
    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }

    /**
     * Create this model's index
     */
    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
            'settings' => [
                'analysis' => [
                    'analyzer' => [
                        'default' => [
                            'type' => 'custom',
                            'char_filter' => ['html_strip'],
                            'tokenizer' => 'standard',
                            'filter' => ['lowercase', /*'ru_stop', 'ru_stemmer'*/]
                        ],
                        'autocomplete' => [
                            'type' => 'custom',
                            'char_filter' => ['html_strip'],
                            'tokenizer' => 'standard',
                            'filter' => ['lowercase', /*'ru_stop', 'ru_stemmer',*/ 'autocomplete_filter']
                        ],
                    ],
                    'filter' => [
                        /*'ru_stop' => [
                            'type' => 'stop',
                            'stopwords' => '_russian_',
                        ],
                        'ru_stemmer' => [
                            'type' => 'stemmer',
                            'language' => 'russian'
                        ],*/
                        'autocomplete_filter' => [
                            'type' => 'edge_ngram',
                            'min_gram' => 1,
                            'max_gram' => 20,
                        ]
                     ]
                ]
            ],
            'mappings' => static::mapping(),
        ]);
    }

    /**
     * Delete this model's index
     */
    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index(), static::type());
    }

    public function indexatorr()
    {
        static::getDb()->createCommand()->insert(
            self::index(),
            '_doc',

            [
                'body' => [
                'page_id' => $this->page_id,
                'status' => $this->status,
                'slug' => $this->slug,
            ]
            ]
        );
    }
}