<?php

namespace application\models;

use application\core\Model;
use application\lib\Db;

class Main extends Model
{
    public function getGoods()
    {
        $result = $this->db->row('SELECT name,cost,description,img FROM goods ORDER BY id DESC LIMIT 10');
        return $result;
    }
}
