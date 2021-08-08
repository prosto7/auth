<?php  
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
}?>

<div id="container_table_php" class="container mt-5">
<h3>Table with data from DB on native PHP with sorting and export CSV</h3>
<button id="export_button" class="btn btn-success">Export CSV</button>
<table class='table table-bordered'>

    <thead class="thead-light">
        <tr>
            <th scope="col">Image</th>
            <th scope="col p-2"><?= sort_link_th('Login', 'logi_asc', 'logi_desc');?></th>
            <th scope="col p-2"><?= sort_link_th('Email', 'email_asc', 'email_desc'); ?></th>
            <th scope="col p-2"><?= sort_link_th('Firstname', 'namefirst_asc', 'namefirst_desc'); ?></th>
            <th scope="col p-2"><?= sort_link_th('Lastname', 'namelast_asc', 'namelast_desc'); ?></th>
            <th scope="col p-2"><?= sort_link_th('Birthday', 'age_asc', 'age_desc'); ?></th>
            <th scope="col p-2"><?= sort_link_th('Gender', 'gender_asc', 'gender_desc'); ?></th>

        </tr>
    </thead>
    <tbody class="">
        <?php foreach ($data as $row) : ?>
            <tr>
                <td><img class="card-img-top" src="<?php echo $row['imagepath']; ?>" alt=""></td>
                <td><?php echo $row['login']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['namefirst']; ?></td>
                <td><?php echo $row['namelast']; ?></td>
                <td><?php echo $row['birthday']; ?></td>
                <td><?php echo $row['gender']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>