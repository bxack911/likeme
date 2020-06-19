<?php

namespace tests\unit;

use Yii;
use PHPUnit\Framework\TestCase;
use common\models\Config;

//require(__DIR__ . '/../_bootstrap.php');

class ConfigTest extends TestCase
{
	public function testValidateWrongValues()
	{
		$model = new Config([
			'key' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum',
			'value' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.',
		]);

		$this->assertFalse($model->validate(), 'validate incorrect page');
		$this->assertArrayHasKey('key', $model->getErrors(), 'check incorrent key');
		$this->assertArrayHasKey('value', $model->getErrors(), 'check incorrent value');
	}

	public function testValidateCorrectValues()
	{
		$model = new Config([
			'key' => 'test_key',
			'value' => 'It\s new block value',
			'comment' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.',
		]);

		$this->assertTrue($model->validate(), 'correct model is valid!');
	}
}
?>