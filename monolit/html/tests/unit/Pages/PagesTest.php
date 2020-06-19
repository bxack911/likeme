<?php

namespace tests\unit;

use Yii;
use PHPUnit\Framework\TestCase;
use common\models\Pages;

//require(__DIR__ . '/../_bootstrap.php');

class PagesTest extends TestCase
{
	public function testValidateWrongValues()
	{
		$model = new Pages([
			'slug' => null,
			'status' => 2,
			'section_id' => 'wrong',
		]);

		$this->assertFalse($model->validate(), 'validate incorrect page');
		$this->assertArrayHasKey('slug', $model->getErrors(), 'check incorrent slug');
		$this->assertArrayHasKey('status', $model->getErrors(), 'check incorrent status');
		$this->assertArrayHasKey('section_id', $model->getErrors(), 'check incorrent section_id');
	}

	public function testValidateCorrectValues()
	{
		$model = new Pages([
			'slug' => 'test_slug',
			'status' => true,
			'section_id' => 2,
		]);

		$this->assertTrue($model->validate(), 'correct model is valid!');
	}

	public function testUrlExist()
	{
		$model = Pages::find()->one();
		$result = true;

		if($model->url == null || $model->url == "" || $model->url == false)
		{
			$result = false;
		}

		$this->assertTrue($result, 'url is null!');
	}

	public function testLinkExist()
	{
		$model = Pages::find()->one();
		$result = true;

		if($model->link == null || $model->link == "" || $model->link == false)
		{
			$result = false;
		}

		$this->assertTrue($result, 'url is null!');
	}

	public function testGetTranslate()
	{
		$model = Pages::find()->one();
		$result = true;


		$this->assertArrayHasKey('title', $model->translate);
		$this->assertArrayHasKey('content', $model->translate);
		$this->assertArrayHasKey('language', $model->translate);
	}

	public function testBeforeSave()
	{
		$model = Pages::find()->one();

		$this->assertTrue($model->beforeSave(null), 'beforeSave don\'t retuned true!');
	}
}
?>