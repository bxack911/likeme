<?php

namespace common\models\query;

use common\models\Section;

/**
 * This is the ActiveQuery class for [[\common\models\Section]].
 *
 * @see \common\models\Section
 */
class SectionQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere(['status' => Section::STATUS_ACTIVE]);
        return $this;
    }

    /**
     * @return $this
     */
    public function inactive()
    {
        $this->andWhere(['status' => Section::STATUS_INACTIVE]);
        return $this;
    }
}
