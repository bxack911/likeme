<?php

namespace common\models\query;

use common\models\Menu;
use creocoder\nestedsets\NestedSetsQueryBehavior;

class MenuQuery extends \yii\db\ActiveQuery
{
  public function behaviors() {
    return [
      NestedSetsQueryBehavior::className(),
    ];
  }

  public function active()
  {
    $this->andWhere(['active' => 0]);
    return $this;
  }

  /**
   * @return $this
   */
  public function inactive()
  {
    $this->andWhere(['active' => 1]);
    return $this;
  }
}
