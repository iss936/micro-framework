<?php
namespace Sql;

use App\core\db\ParentSql;

class UserSql extends ParentSql       
{
    public function findAll() {

        $req = "select * from user";
        $res = $this->db->query($req);
        $tab = $res->fetchAll();
        
        return $tab;
    }
}
