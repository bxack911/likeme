<?php
namespace common\modules\shop\common\models\addons\classes;

class NovaPoshta {
  public function renderForm()
  {
    return $this->render('nova_poshta');
  }

  public function returnCities()
  {
    return 'city';
  }
}
