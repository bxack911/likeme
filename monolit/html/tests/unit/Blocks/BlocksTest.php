<?php

namespace tests\unit;

use Yii;
use PHPUnit\Framework\TestCase;
use common\models\Blocks;

//require(__DIR__ . '/../_bootstrap.php');

class BlocksTest extends TestCase
{
	public function testValidateWrongValues()
	{
		$model = new Blocks([
			'name' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.',
			'created_at' => null,
			'updated_at' => null,
			'created_by' => null,
			'updated_by' => null
		]);

		$this->assertFalse($model->validate(), 'validate incorrect page');
		$this->assertArrayHasKey('name', $model->getErrors(), 'check incorrent block name');
	}

	public function testValidateCorrectValues()
	{
		$model = new Blocks([
			'name' => 'Block name',
		]);

		$this->assertTrue($model->validate(), 'correct model is valid!');
	}
}
?>