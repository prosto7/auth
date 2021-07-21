<?php 

class Model_Data extends Model {

    function get_data_table_nativephp() 
    {

        $sort_list = array(
            'logi_asc'   => '`login`',
            'logi_desc'  => '`login` DESC',
            'email_asc'  => '`email`',
            'email_desc' => '`email` DESC',
            'namefirst_asc'   => '`namefirst`',
            'namefirst_desc'   => '`namefirst`DESC',
            'namelast_asc'  => '`namelast`',
            'namelast_desc'  => '`namelast` DESC',
            'age_asc'   => '`age`',
            'age_desc'  => '`age` DESC',
            'gender_asc'   => '`gender`',
            'gender_desc'  => '`gender` DESC',
            'imagepath_asc' => 'imagepath'
        );

        $sort = @$_GET['sort'];
        if (array_key_exists($sort, $sort_list)) {
            $sort_sql = $sort_list[$sort];
        } else {
            $sort_sql = reset($sort_list);
        }

        $ps = DB::run("SELECT * FROM `users` ORDER BY {$sort_sql}");
        $list = $ps->fetchAll(PDO::FETCH_ASSOC);
        return $list;    
    }

       
}

?>