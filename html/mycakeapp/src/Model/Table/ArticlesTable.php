<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\Query;

class ArticlesTable extends Table
{
    public function findPublished(Query $query, array $options)
    {
        $query->where([
            $this->alias() . '.published' => 1
        ]);
        return $query;
    }

    public function findIdTitleArray(Query $query, array $options)
    {
        /*
        [1] => Array
        (
            [id] => 2
            [title] => Second Article
            [body] => Second Article Body
            [published] => 1
            [created] => Cake\I18n\Time Object
                (
                    [time] => 2007-03-18 10:41:23.000000+09:00
                    [timezone] => Asia/Tokyo
                    [fixedNowTime] =>
                )
            [modified] => Cake\I18n\Time Object
                (
                    [time] => 2007-03-18 10:43:31.000000+09:00
                    [timezone] => Asia/Tokyo
                    [fixedNowTime] =>
                )
        )
        */
        $array = $query->find('all')->enableHydration(false)->toArray();
        foreach ($array as $data) {
            $idTitleArray[] = [
                'id' => $data['id'],
                'title' => $data['title']
            ];
        }
        return $idTitleArray ?? [];
    }
}
