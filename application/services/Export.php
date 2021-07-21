<?php
class Export {
    
    public static function exportToCSV()
    {
       $result= DB::run("SELECT id,login,email,namefirst,namelast,age,gender FROM users");

        $fields = array_keys($result->fetch(PDO::FETCH_ASSOC));
        $filelocation = DS.'exports/';
        $filename     = 'export-'.date('Y-m-d H.i.s').'.csv';
        $file_export  =  $filelocation . $filename;
        $data = fopen($file_export, 'w+');
        fputcsv($data, $fields);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($data, $row);
        }
        
        fclose($data);
     
    }
}
?>

