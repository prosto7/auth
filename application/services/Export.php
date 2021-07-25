<?php
class Export {
    
    public static function exportToCSV($result)
    {
        $filelocation = DS.'exports/';
        $filename     = 'export-'.date('Y-m-d H.i.s').'.csv';
        $file_export  =  $filelocation . $filename;
        if (is_array($result[0])==true) {
        $fields = array_keys($result[0]);
         // первая строка - кейс
        $data = fopen($file_export, 'w+');
        fputcsv($data, $fields);
        foreach($result as $row){
            fputcsv($data, $row);
        }
    } else {
            echo "Invalid incoming data. Multidimensional array expected ";
        }
      
        fclose($data);
     
    }
}
?>

