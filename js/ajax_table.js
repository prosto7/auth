
        $(document).ready(function() {
            var table = $('#empTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': './application/models/model_table.php'
                },

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

              
            });

        });
