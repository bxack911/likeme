<?php

namespace common\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class TransliterBehavior extends Behavior{
    public function events(){
        return [
          ActiveRecord::EVENT_BEFORE_INSERT => 'translitUrl',
          ActiveRecord::EVENT_BEFORE_UPDATE => 'translitUrl'
        ];
    }

    public function translitUrl()
    {
        $translit = "ru_en";
        $RU['ru'] = array(
            'Ё', 'Ж', 'Ц', 'Ч', 'Щ', 'Ш', 'Ы',
            'Э', 'Ю', 'Я', 'ё', 'ж', 'ц', 'ч',
            'ш', 'щ', 'ы', 'э', 'ю', 'я', 'А',
            'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И',
            'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
            'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ъ',
            'Ь', 'а', 'б', 'в', 'г', 'д', 'е',
            'з', 'и', 'й', 'к', 'л', 'м', 'н',
            'о', 'п', 'р', 'с', 'т', 'у', 'ф',
            'х', 'ъ', 'ь', '/'
        );

        $EN['en'] = array(
            "Yo", "Zh",  "Cz", "Ch", "Shh","Sh", "Y'",
            "E'", "Yu",  "Ya", "yo", "zh", "cz", "ch",
            "sh", "shh", "y'", "e'", "yu", "ya", "A",
            "B" , "V" ,  "G",  "D",  "E",  "Z",  "I",
            "J",  "K",   "L",  "M",  "N",  "O",  "P",
            "R",  "S",   "T",  "U",  "F",  "Kh",  "''",
            "'",  "a",   "b",  "v",  "g",  "d",  "e",
            "z",  "i",   "j",  "k",  "l",  "m",  "n",
            "o",  "p",   "r",  "s",  "t",  "u",  "f",
            "h",  "''",  "'",  "-"
        );


        if($this->owner->slug == "") {
            $lang_model = $this->owner->getTranslate();
                $t = str_replace($RU['ru'], $EN['en'], $lang_model->title);
                $t = preg_replace("/[\s]+/u", "_", $t);
                $t = preg_replace("/[^a-z0-9_\-]/iu", "", $t);
                $t = strtolower($t);
            $this->owner->slug = $t;
        }
    }
}

?>