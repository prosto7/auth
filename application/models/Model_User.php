<?php 

class Model_User extends Model
{
    //  handler data for auth
    public function get_data_user()
    {

        $login = $_POST['login'];
        $password = $_POST['password'];
        $sql = DB::run("SELECT salt,pass,roleid FROM `users` WHERE `login` = :login", ['login' => $login]);
        $salt_row = $sql->fetch(PDO::FETCH_ASSOC);
        if ($salt_row != false) {
            $hashed_password = $salt_row['pass'];
            $salt_one = $salt_row['salt'];
            // select salt and pass from DB , for further verification users
            $ps = DB::instance()->prepare("SELECT COUNT(*) FROM `users` WHERE `login` = :login");
            $ps->bindParam(':login', $login);
            $ps->execute();
            $row_count = $ps->fetchColumn();
            if ($row_count == 1 && hash_equals($hashed_password, crypt($password, $salt_one)))   // if table `users` has this login and hash password matches the entered password, user come in site
            {
                if ($salt_row['roleid'] === '1') {
                    // if roleid in the table 1 user is SuperAdministrator can see new section 'Admin Forms' and he can update, delete and add users in the DB
                    $_SESSION['superadmin'] =  $admin;
                } else {
                    $_SESSION['register'] = $login;  // SESSION[register] - simple user (roleid = 2, it's default setting) can see the table with data list
                }
                $result = [
                    "status" => true

                ];
            } else {

                $result = [
                    "status" => false,
                    "message" => "Password is invalid!"
                ];
            }
        } else {
            $result = [
                "status" => false,
                "message" => "User not found!"
            ];
        }

        echo json_encode($result);
    }


    //  handler data for table
    public function get_data_table()
    {

        ## Read value
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $data =  $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        $searchArray = array();

        ## Search 
        $searchQuery = " ";
        if ($searchValue != '') {
            $searchQuery = " AND (namefirst LIKE :namefirst OR  
       email LIKE :email OR 
       namelast LIKE :namelast OR 
       login LIKE :login ) ";
            $searchArray = array(
                'namefirst' => "%$searchValue%",
                'email' => "%$searchValue%",
                'namelast' => "%$searchValue%",
                'login' => "%$searchValue%",
            );
        }

        ## Total number of records without filtering
        $stmt = DB::instance()->prepare("SELECT COUNT(*) AS allcount FROM users ");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        ## Total number of records with filtering
        $stmt = DB::instance()->prepare("SELECT COUNT(*) AS allcount FROM users WHERE 1 " . $searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $stmt = DB::instance()->prepare("SELECT * FROM users WHERE 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

        // Bind values
        foreach ($searchArray as $key => $search) {
            $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        $data = array();

        foreach ($empRecords as $row) {
            $data[] = array(
                "imagepath" => $row['imagepath'],
                "login" => $row['login'],
                "email" => $row['email'],
                "namefirst" => $row['namefirst'],
                "namelast" => $row['namelast'],
                "birthday" => $row['birthday'],
                "gender" => $row['gender'],
                "id" => $row['id'],
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }

 function reg_user_in_db($login, $pass, $email, $namefirst, $namelast, $birthday, $gender, $imagepath, $id = 0){


   $pdo = DB::instance();
    $checker = $pdo->prepare("SELECT COUNT(*) FROM `users` WHERE `login` = :login");
    $checker->bindParam(':login', $login);
    $checker->execute();
    $row_count = $checker->fetchColumn();
    if ($row_count !== 1) {   // if table `users` has this login and hash password matches the entered password, user come in site
        $ps = $pdo->prepare("INSERT INTO users (login, pass, roleid, email, namefirst, namelast, birthday, gender,imagepath,salt) VALUES (:login, :pass, :roleid, :email,:namefirst, :namelast, :birthday, :gender, :imagepath,:salt)");
        // naming an object this, and transform to array
        $ar = (array)$this;
        array_shift($ar);
        // delete first element array  :id
        // ar = :login, :pass, :roleid, :email, :namefirst, :namelast ,:birthday, :gender,:imagepath          
        $ps->execute($ar);
        $result = true;
        return $result;
    } else {
        echo "Handler captured error";
        $result = false;
        $ps = null;
        $pdo = null;
        $checker = null;
        return $result; 
    }
   
} 

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
        'age_asc'   => '`birthday`',
        'age_desc'  => '`birthday` DESC',
        'gender_asc'   => '`gender`',
        'gender_desc'  => '`gender` DESC',
        'imagepath_asc' => 'imagepath'
    );

    if(isset($_GET['sort'])) {
        $sort = $_GET['sort'];
         
    } else {
        $sort = 'logi_asc'; 
    }

    $sort_sql =  $sort_list[$sort];
  
        
    $ps = DB::run("SELECT imagepath,id,login,email,namefirst,namelast,birthday,gender FROM `users` ORDER BY {$sort_sql}");


    $result = $ps->fetchAll(PDO::FETCH_ASSOC);
  
    return $result;    
}

    // function prepareData(){



    // }

    function check_user($login, $email)
    {
        $result = DB::run("SELECT COUNT(*) FROM `users` WHERE login = '" . $login . "' OR email = '" . $email . "'");
        $count = $result->fetchColumn();
        return $count;
    }


    function insert_user($data)
    {
       DB::run("INSERT INTO users (login,email,pass,namefirst,namelast,birthday, gender,salt) VALUES (:login,:email,:pass,:namefirst,:namelast,:birthday,:gender,:salt)",$data);
       
    }



    }



