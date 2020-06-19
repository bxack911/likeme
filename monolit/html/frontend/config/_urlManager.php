<?php

return [
  'class' => 'frontend\components\UrlManager',
  'enableLanguageDetection' => false,
  'enableLanguagePersistence' => false,
  'enablePrettyUrl' => true,
  'showScriptName' => false,
  'enableStrictParsing' => true,
  'rules' => [

    // Slug routes
    ['class' => 'frontend\components\SlugRouteRule'],

    // SeoController
    'form/<action>/<model:\w+>' => 'form/<action>',
    'vue/<action>/<param:\w+>' => 'vue/<action>',
    'vue/<action>' => 'vue/<action>',
    'shop/search/<action>' => 'shop/search/<action>',
    'shop/filter/<action>/<param:\w+>' => 'shop/filter/<action>',
    'shop/favourite/<action>' => 'shop/favourite/<action>',
    'shop/favourite/<action>/<param:\w+>' => 'shop/favourite/<action>',
    'shop/cart/<action>/<param:\w+>' => 'shop/cart/<action>',
    'shop/cart/<action>/<param:\w+>/<quantity:\w+>' => 'shop/cart/<action>',
    'shop/cart/<action>' => 'shop/cart/<action>',
    'sitemap' => 'seo/sitemap',
    'sitemap.xml' => 'seo/sitemap-xml',
    'robots.txt' => 'seo/robots',
  ],
];
