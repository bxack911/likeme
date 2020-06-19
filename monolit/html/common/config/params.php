<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'pagesActions' => [
      'pages/home' => Yii::t('backend','Homepage'),
      'shop/cart/cart-page' => Yii::t('backend','Cartung'),
      'shop/favourite/favourite-page' => Yii::t('backend','Favourite'),
      'shop/search/search' => Yii::t('backend','Search'),
      'shop/order/view' => Yii::t('backend','Order'),
      'shop/order/result' => Yii::t('backend','Order result'),
    ],
    'sectionActions' => [

    ],
    'categoryActions' => [
      'shop/category/catalog' => Yii::t('backend', 'Catalog')
    ],
    'productsActions' => [
    ]
];
