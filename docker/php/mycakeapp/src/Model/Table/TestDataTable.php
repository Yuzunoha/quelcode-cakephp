<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TestDataTable extends Table
{
  public function initialize(array $config)
  {
    parent::initialize($config);

    $this->setTable('test_data');
    $this->setDisplayField('name');
    $this->setPrimaryKey('id');

    $this->addBehavior('Timestamp');
  }

  public function validationDefault(Validator $validator)
  {
    $validator
      ->scalar('name')
      ->requirePresence('name', 'create')
      ->notEmptyString('name');

    return $validator;
  }

  public function buildRules(RulesChecker $rules)
  {
    return $rules;
  }
}
