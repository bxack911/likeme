<?php

namespace common\modules\shop\common\models\query;

use common\modules\shop\common\models\Category;

/**
 * This is the ActiveQuery class for [[\common\models\Products]].
 *
 * @see \common\models\Products
 */
class PaysystemsQuery extends \yii\db\ActiveQuery
{
  public function active()
  {
    $this->andWhere(['status' => Category::STATUS_ACTIVE]);
    return $this;
  }

  /**
   * @return $this
   */
  public function inactive()
  {
    $this->andWhere(['status' => Category::STATUS_INACTIVE]);
    return $this;
  }
}
