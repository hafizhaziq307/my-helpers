<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajax datatable</title>

    <!-- Datatable CSS -->
    <link rel="stylesheet" href='//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css'>

    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Datatable JS -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>

<body>

    <main>
        <table id="mytable"></table>
    </main>

    <script>
        $(document).ready(function() {
            $('#mytable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': 'ajaxDatatable.php',
                    'data': (data) => {
                        data.tableName = "tblUser";
                        data.fields = ["ID", "No_IC", "NamaPenuh", "Email", "Peranan"];
                        data.excludeSearchFields = ["ID"];
                    },
                    'error': (err) => console.error(err.responseText),
                },
                'columns': [{
                        title: "NO KP",
                        data: 'No_IC'
                    },
                    {
                        title: "NAMA",
                        data: 'NamaPenuh'
                    },
                    {
                        title: "EMEL",
                        data: 'Email'
                    },
                    {
                        title: "PERANAN",
                        data: 'Peranan'
                    },
                ]
            });
        });
    </script>

</body>

</html>