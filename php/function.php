<?php
// fungsi koneksi db
function koneksi()
{
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "pw_tubes_203040096");
    return $conn;
}
// fungsi masukan hasil query ke array
function query($sql)
{
    $conn = koneksi();
    $res = mysqli_query($conn, "$sql");
    $rows = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $rows[] = $row;
    }
    return $rows;
}
// fungsi merubah format harga
function rupiah($harga)
{
    $hasil_harga = "Rp. " . number_format($harga, 2, ',', '.');
    return $hasil_harga;
}

// generate user img
function getProfilePicture($name)
{
    $name_slice = explode(' ', $name);
    $name_slice = array_filter($name_slice);
    $initials = '';
    $initials .= (isset($name_slice[0][0])) ? strtoupper($name_slice[0][0]) : '';
    // $initials .= (isset($name_slice[count($name_slice) - 1][0])) ? strtoupper($name_slice[count($name_slice) - 1][0]) : '';
    return '<div class="profile-pic mx-auto">' . $initials . '</div>';
}
// upload gambar
function uploadImage($url, $data, $action)
{

    $imgFile = $_FILES['img']['name'];
    $tmp_dir = $_FILES['img']['tmp_name'];
    $imgSize = $_FILES['img']['size'];

    if (empty($imgFile)) {
        if ($action == 'upload-user-admin') {
            registrasi_admin($data, '');
        }

        if ($action == 'edit-user-admin') {
            ubah_admin($data, '');
        } else if ($action == 'edit-product') {
            ubah($data, '');
        } else if ($action == 'edit-brand') {
            ubah_brand($data, '');
        } else if ($action == 'edit-user') {
            ubah_user($data, '');
        }
    } else {
        $upload_dir = $url; // upload directory
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
        // rename uploading image
        if ($action == 'upload-user-admin' || $action == 'edit-user-admin') {
            $imgName = substr($data['username'], 0, 3) . rand(1000, 1000000) . "." . $imgExt;
        } else if($action == 'upload-product' || $action == 'edit-product'){
            $imgName = substr($data['name'], 0, 3) . rand(1000, 1000000) . "." . $imgExt;
        } else if($action == 'upload-brand' || $action == 'edit-brand'){
            $imgName = substr($data['name'], 0, 3) . rand(1000, 1000000) . "." . $imgExt;
        } else if($action == 'edit-user'){
            $imgName = substr($data['username'], 0, 3) . rand(1000, 1000000) . "." . $imgExt;
        }
        
        // allow valid image file formats
        if (in_array($imgExt, $valid_extensions)) {
            // Check file size '5MB'
            if ($imgSize < 5000000) {

                if ($action == 'upload-user-admin') {
                    registrasi_admin($data, $imgName);
                } else if ($action == 'upload-product') {
                    tambah($data,$imgName);
                } else if ($action == 'upload-brand') {
                    tambah_brand($data,$imgName);
                }

                if ($action == 'edit-user-admin') {
                    unlink($upload_dir . $data['old_img']);
                    ubah_admin($data, $imgName);
                } else if ($action == 'edit-product') {
                    unlink($upload_dir . $data['old_img']);
                    ubah($data, $imgName);
                } else if ($action == 'edit-brand') {
                    unlink($upload_dir . $data['old_img']);
                    ubah_brand($data, $imgName);
                } else if ($action == 'edit-user') {
                    // unlink($upload_dir . $data['old_img']);
                    ubah_user($data, $imgName);
                }

                move_uploaded_file($tmp_dir, $upload_dir . $imgName);
            } else {
                return "tooLarge";
            }
        } else {
            return "notImage";
        }
    }
    return "success";
}
