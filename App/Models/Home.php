<?php
    namespace App\Models;
    use App\Models\DB;
    use App\Models\Helper;

    class Home{
        
        public static function get(){
            $sql = "SELECT
                    case
                        when table_name = 'cashiers' then 'Caixas'
                        when table_name = 'localities' then 'Localidades'
                        when table_name = 'orders' then 'Pedidos'
                        when table_name = 'products' then 'Produtos'
                        when table_name = 'sections' then 'Seções'
                        when table_name = 'users' then 'Funcionarios'
                        else table_name end as name,
                        table_name as url
                    FROM
                        information_schema.tables
                    WHERE
                        table_schema = 'ebsys' and table_name in('cashiers', 'localities', 'orders', 'products', 'sections', 'users')
                    ORDER BY name ASC"; 
            return DB::sqlSelect($sql);
        }

        // public static function post(){
        //     return DB::insert();
        // }

        // public static function put(){
        //     return DB::update();
        // }

        // public static function delete(){
        //     return DB::delete();
        // }
    }