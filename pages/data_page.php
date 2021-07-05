<?php include_once('menu.php');
include_once('classes.php'); ?>

<!-- Page with data list, with search,sort, pagination and modal windows -->

<div class='container mt-5 main-data__container'>
    <h2>Personal database of CIA agents</h2>
    <p>Top secret</p>
</div>
<?php
if (isset($_SESSION['register']) || isset($_SESSION['superadmin'])) {
?>



    <div class="container  mt-5 mb-5">
        <!-- Table -->
        <table id='empTable' class='display dataTable table'>
            <thead class="table-success">
                <tr>
                    <th>Image</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Date Birthday</th>
                    <th>Gender</th>
                    <th>Id</th>
                </tr>
            </thead>

        </table>
    </div>

    <!-- Script for create table with our data  -->
    <script>
        $(document).ready(function() {

            var table = $('#empTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': 'ajaxfile.php'
                },

                'columns': [

                    {
                        data: 'imagepath',
                        "render": function(data, type, row) {
                            return '<img class="picture" src="/' + data + '" />';
                        }
                    }, // render image
                    {
                        data: 'login'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'namefirst'
                    },
                    {
                        data: 'namelast'
                    },
                    {
                        data: 'age'
                    },
                    {
                        data: 'gender',
                        "visible": false
                    },
                    {
                        data: 'id',
                        "visible": false
                    } // id is hide,but it's need for initialisation data and draw modal window with data 


                ],

                // add className exampleModal + user's id for identification and download data in the modal window 
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('exampleModal' + '' + data['id'] + '');
                },
            });

            // add the get parametr 'id' for opening modal window
            $('#empTable tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
                window.location.replace(window.location.href + '?id=' + '' + data['id'] + '');

            });

        });
    </script>

    <?php

    if (isset($_GET['id'])) {

        $user_id = ($_GET['id']);
        $link = Tools::alternativeConnect();
        $new_id = mysqli_query($link, "SELECT * FROM `users` WHERE id='$user_id'");
        $new_id = mysqli_fetch_all($new_id);
        $new_id_for_draw = $new_id[0];
        echo "<script>
        $('.exampleModal$news_id_for_draw[0]').ready(function(){
        $('#exampleModal').arcticmodal({
        afterClose: function(data, el) {
        history.pushState(null, '', './data_page.php');
        }
        })
        });
        </script>";
    }

    ?>
    <!-- Modal window -->
    <div style="display: none;">
        <div class="box-modal" id="exampleModal">
            <div class="box-modal_close arcticmodal-close">закрыть</div>
            <div class="container mt-5">
                <div class="row">

                    <div class='col-6'>
                        <h3><?= $new_id_for_draw[1] ?></h3>
                        <h5><?= $new_id_for_draw[5] . ' ' . $new_id_for_draw[6] ?></h5>
                        <p><?= $new_id_for_draw[4] ?></p>
                        <p><span>Date birthday: </span><b><?= $new_id_for_draw[7] ?></b></p>
                        <p><span>Sex: </span><b><?= $new_id_for_draw[8] ?></b></p>
                    </div>
                    <div class='col-6'>
                        <img class="picture_in_modal" src="<?= $new_id_for_draw[9] ?>" alt="">
                    </div>
                </div>

                <div class="row">
                    <div class="container">

                    </div>
                </div>
                <div class="row">
                    <div class="container">

                    </div>
                </div>
            </div>
            <div class="box-modal_close arcticmodal-close">закрыть</div>
        </div>
    </div>
    </body>

    </html>
<?php
}
?>