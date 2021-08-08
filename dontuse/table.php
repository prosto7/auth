<!-- Page with data list on php with sort -->
<?php $sort_list = array(
    'login_asc'   => '`login`',
    'login_desc'  => '`login` DESC',
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

$pdo = Tools::connect();
$ps = $pdo->prepare("SELECT * FROM `users` ORDER BY {$sort_sql}");
$ps->execute();
$list = $ps->fetchAll(PDO::FETCH_ASSOC);


function sort_link_th($title, $a, $b)
{
    $sort = @$_GET['sort'];

    if ($sort == $a) {
        return '<a class="active" href="?sort=' . $b . '">' . $title . '<i>▲</i></a>';
    } elseif ($sort == $b) {
        return '<a class="active" href="?sort=' . $a . '">' . $title . '<i>▼</i></a>';
    } else {
        return '<a href="?sort=' . $a . '">' . $title . '</a>';
    }
}

?>

<table class='table'>
    <thead class="thead-light">
        <tr>
            <th scope="col">Image</th>
            <th scope="col p-2"><?php echo sort_link_th('Login', 'login_asc', 'login_desc'); ?></th>
            <th scope="col p-2"><?php echo sort_link_th('Email', 'email_asc', 'email_desc'); ?></th>
            <th scope="col p-2"><?php echo sort_link_th('Firstname', 'namefirst_asc', 'namefirst_desc'); ?></th>
            <th scope="col p-2"><?php echo sort_link_th('Lastname', 'namelast_asc', 'namelast_desc'); ?></th>
            <th scope="col p-2"><?php echo sort_link_th('Birthday', 'age_asc', 'age_desc'); ?></th>
            <th scope="col p-2"><?php echo sort_link_th('Gender', 'gender_asc', 'gender_desc'); ?></th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $row) : ?>
            <tr>
                <td><img class="card-img-top" src="<?php echo $row['imagepath']; ?>" alt=""></td>
                <td><?php echo $row['login']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['namefirst']; ?></td>
                <td><?php echo $row['namelast']; ?></td>
                <td><?php echo $row['age']; ?></td>
                <td><?php echo $row['gender']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>