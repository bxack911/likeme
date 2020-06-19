<?php

namespace tests\unit;

use Yii;
use PHPUnit\Framework\TestCase;
use common\models\Pages;

//require(__DIR__ . '/../_bootstrap.php');

class DbTest extends TestCase
{
	public function testBlocksTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('blocks');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to blocks table!');
	}

	public function testBlocksTranslationTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('blocks_translation');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to blocks_translation table!');
	}

	public function testConfigTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('config');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to config table!');
	}

	public function testLanguageTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('language');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to language table!');
	}

	public function testMenuTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('menu');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to menu table!');
	}

	public function testMenuItemTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('menu_item');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to menu_item table!');
	}

	public function testMenuItemTraslationTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('menu_item_translation');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to menu_item_translation table!');
	}

	public function testModuleTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('module');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to module table!');
	}

	public function testPagesTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('pages');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to pages table!');
	}

	public function testPagesTranslationTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('pages_translation');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to pages_translation table!');
	}

	public function testRoutesTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('routes');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to routes table!');
	}

	public function testSectionTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('section');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to section table!');
	}

	public function testSectionTranslationTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('section_translation');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to section_translation table!');
	}


	public function testUserTableExist()
	{
		$result = true;
		$tableSchema = Yii::$app->db->schema->getTableSchema('user');

		if($tableSchema == null)
		{
			$result = false;
		}
		
		$this->assertTrue($result, 'Cann\'t connect to # table!');
	}
}
?>