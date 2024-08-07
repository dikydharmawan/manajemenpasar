<?php
include("config.php");
$result = mysqli_query($conn, "SELECT * FROM sayuran ORDER BY id ASC");
if (!$result) {
    die("Query error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Dagang Sayuran</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        #table_id thead th {
            color: black;
            background-color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Manajemen Dagang Sayuran</h1>
        <a href="add.php" class="btn btn-primary mb-3">TAMBAH SAYUR</a>
        <a href="print.php" target="_blank" class="btn btn-info mb-3 ms-2"><i class="fas fa-print"></i> Cetak Data</a>
        <table id="table_id" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Sayuran</th>
                    <th>Harga (Rp)</th>
                    <th>Stok (kg)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($user_data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$user_data['id']}</td>";
                echo "<td>{$user_data['nama']}</td>";
                echo "<td>" . number_format($user_data['harga'], 0, ',', '.') . "</td>";
                echo "<td>{$user_data['stok']}</td>";
                echo "<td>
                    <a href='edit.php?id={$user_data['id']}' class='btn btn-warning btn-sm'>Edit</a> 
                    <button onclick='sweetalert({$user_data['id']})' class='btn btn-danger btn-sm'>Hapus</button>
                    </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <script>
    $(document).ready(function() {
        $('#table_id').DataTable({
            dom: 'Bfrtip',
            buttons: ['pdf']
        });
    });

    function sweetalert(id) {
        swal({
            title: "Apakah Anda Yakin?",
            text: "Jika Data Dihapus, Maka Data Tidak Akan Bisa Dipulihkan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = 'delete.php?id=' + id;
            } else {
                swal("Data Anda Aman");
            }
        });
    }
    </script>
    
    <div class="container p-1 my-5 h-1 bg-primary text-white">
        <p class="text-center">&copy Dikydharmawan1219</p>
    </div>
</body>
</html>
<?php
if(isset($_GET['status']) && isset($_GET['message'])) {
    $status = $_GET['status'];
    $message = $_GET['message'];
    echo "<div class='alert alert-{$status} alert-dismissible fade show' role='alert'>
            {$message}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}
?>