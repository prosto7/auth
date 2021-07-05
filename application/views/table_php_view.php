<div class='container mt-5 main-data__container'>
    <h2>Personal database of CIA agents</h2>
    <p>Top secret</p>
</div>




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