<?php

namespace tests\unit;

use Yii;
use PHPUnit\Framework\TestCase;
use common\models\Blocks;

//require(__DIR__ . '/../_bootstrap.php');

class BlocksTranslationTest extends TestCase
{

	public function testValidateCorrectValues()
	{
		$model = new Blocks([
			'name' => 'Block name',
		]);

		$this->assertTrue($model->validate(), 'correct model is valid!');
	}
}
?>