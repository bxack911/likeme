<?php

namespace common\modules\shop\common\models\query;

use common\modules\shop\common\models\Products;

/**
 * This is the ActiveQuery class for [[\common\models\Products]].
 *
 * @see \common\models\Products
 */
class ProductsQuery extends \yii\db\ActiveQuery
{
  public function active()
  {
    $this->andWhere(['status' => Products::STATUS_ACTIVE]);
    return $this;
  }

  /**
   * @return $this
   */
  public function inactive()
  {
    $this->andWhere(['status' => Products::STATUS_INACTIVE]);
    return $this;
  }
}
