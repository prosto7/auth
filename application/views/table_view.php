<div class='container mt-5 main-data__container'>
    <h2>Table with User's data, with using js library "DataTable"</h2>
    <p>(sorting, search, pagination, exporting csv,excel,pdf)</p>
</div>

    <div class="container mt-5 mb-5">
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
                       'url':'/table'
                   },
                   'dataSrc': "",
                   dom: 'Bfrtlip',
                   
                   searching: true,
                   "lengthMenu" : [[5, 10,25,50,100000], [5,10, 25, 50, "All"]],
                   lengthChange: true,
                      buttons: [ 'copy', 'excel','csv','pdf' ],
                   'columns': [
   
                       {
                           data: 'imagepath',
                           "render": function(data, type, row) {
                               return '<img class="picture" src="./' + data + '" />';
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
                           data: 'birthday'
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
          

} ); 



    });


       </script>