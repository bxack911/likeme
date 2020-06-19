<?php

namespace common\models\query;

use common\models\Gallery;

/**
 * This is the ActiveQuery class for [[\common\models\Gallery]].
 *
 * @see \common\models\Material
 */
class GalleryQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere(['status' => Gallery::STATUS_ACTIVE]);
        return $this;
    }

    /**
     * @return $this
     */
    public function inactive()
    {
        $this->andWhere(['status' => Gallery::STATUS_INACTIVE]);
        return $this;
    }
}
