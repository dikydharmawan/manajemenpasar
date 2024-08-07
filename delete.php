<?php
include_once("config.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mulai transaksi
    mysqli_begin_transaction($conn);

    try {
        // Hapus catatan
        $result = mysqli_query($conn, "DELETE FROM sayuran WHERE id=$id");

        if($result) {
            // Kurangi ID yang lebih besar dari ID yang dihapus
            $update_ids = mysqli_query($conn, "UPDATE sayuran SET id = id - 1 WHERE id > $id");

            if($update_ids) {
                // Atur ulang auto_increment
                $max_id_query = mysqli_query($conn, "SELECT MAX(id) as max_id FROM sayuran");
                $max_id_result = mysqli_fetch_assoc($max_id_query);
                $max_id = $max_id_result['max_id'];

                $reset_auto_increment = mysqli_query($conn, "ALTER TABLE sayuran AUTO_INCREMENT = " . ($max_id + 1));

                if($reset_auto_increment) {
                    mysqli_commit($conn);
                    header("Location: index.php?status=success&message=" . urlencode("Data berhasil dihapus"));
                } else {
                    throw new Exception("Gagal mengatur ulang auto_increment.");
                }
            } else {
                throw new Exception("Gagal memperbarui ID.");
            }
        } else {
            throw new Exception("Gagal menghapus data.");
        }
    } catch (Exception $e) {
        mysqli_rollback($conn);
        header("Location: index.php?status=error&message=" . urlencode($e->getMessage()));
    }
} else {
    header("Location: index.php?status=error&message=" . urlencode("ID tidak valid."));
}

exit();
?>