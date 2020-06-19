<?php

namespace common\models\query;

use common\models\Language;

/**
 * This is the ActiveQuery class for [[\common\models\Language]].
 *
 * @see \common\models\Language
 */
class LanguageQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere(['status' => Language::STATUS_ACTIVE]);
        return $this;
    }

    /**
     * @return $this
     */
    public function inactive()
    {
        $this->andWhere(['status' => Language::STATUS_INACTIVE]);
        return $this;
    }
}
