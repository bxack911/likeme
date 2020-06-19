<?php

namespace tests\unit;

use PHPUnit\Framework\TestCase;
use common\models\PagesTranslation;

//require(__DIR__ . '/../_bootstrap.php');

class PagesTranslationTest extends TestCase
{
	public function testValidateCorrectValues()
	{
		$model = new PagesTranslation([
			'title' => 'Testing title',
			'language' => 'ru',
			'content' => 'Testing comtent',
		]);

		$this->assertTrue($model->validate(), 'correct model is valid');
	}
}
?>