<?php

namespace tests\unit;

use Yii;
use PHPUnit\Framework\TestCase;
use common\models\Language;

//require(__DIR__ . '/../_bootstrap.php');

class LanguageTest extends TestCase
{
	public function testValidateWrongValues()
	{
		$model = new Language([
			'code' => null,
			'locale' => null,
			'title' => null,
			'status' => 2,
			'sort_order' => 'a',
		]);

		$this->assertFalse($model->validate(), 'validate incorrect page');
		$this->assertArrayHasKey('code', $model->getErrors(), 'check incorrent code');
		$this->assertArrayHasKey('locale', $model->getErrors(), 'check incorrent locale');
		$this->assertArrayHasKey('title', $model->getErrors(), 'check incorrent title');
		$this->assertArrayHasKey('status', $model->getErrors(), 'check incorrent status');
		$this->assertArrayHasKey('sort_order', $model->getErrors(), 'check incorrent sort_order');
	}

	/*public function testValidateCorrectValues()
	{
		$model = new Language([
			'code' => "ru",
			'locale' => "ru_RU",
			'title' => "Русский",
			'status' => 1,
			'sort_order' => 0,
		]);

		$this->assertTrue($model->validate(), 'Language model is valid!');
	}*/
}
?>