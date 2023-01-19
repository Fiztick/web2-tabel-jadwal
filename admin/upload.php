<?php
require_once '../connection.php';
require_once '../config/excel_reader2.php';

$file = $_FILES['file']['tmp_name'];
$fileType = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

$i = 0;

switch ($fileType) {
    case 'xls':
    case 'xlsx':
        $data = new Spreadsheet_Excel_Reader($file);
        $i = 2;
        break;
    case 'csv':
        $data = array_map('str_getcsv', file($file));
        $i = 1;
        break;
    default:
        echo "<script>alert('Invalid file type. Please upload an excel or csv file.'); window.location.href='data_jadwal.html' </script>";
        exit;
}

$numRows = count($data);

// Prepare the insert statement
$sql = "INSERT INTO jadwal (kelas, hari, min, max, matkul, dosen, ruang) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $sql);

// Bind the variables to the statement
mysqli_stmt_bind_param($stmt, 'sssssss', $kelas, $hari, $min, $max, $matkul, $dosen, $ruang);

for ($i; $i < $numRows; $i++) {
    
    $kelas = $data[$i][0];
    $hari = $data[$i][1];
    $min = $data[$i][2];
    $max = $data[$i][3];
    $matkul = $data[$i][4];
    $dosen = $data[$i][5];
    $ruang = $data[$i][6];

    // Execute the statement
    mysqli_stmt_execute($stmt);
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($con);

header("Location: data_jadwal.php");
?>
