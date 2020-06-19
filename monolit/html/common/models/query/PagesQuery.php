<?php

namespace common\models\query;

use common\models\Pages;

/**
 * This is the ActiveQuery class for [[\common\models\Pages]].
 *
 * @see \common\models\Pages
 */
class PagesQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere(['status' => Pages::STATUS_ACTIVE]);
        return $this;
    }

    /**
     * @return $this
     */
    public function inactive()
    {
        $this->andWhere(['status' => Pages::STATUS_INACTIVE]);
        return $this;
    }
}
