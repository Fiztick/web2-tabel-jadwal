<?php

function put_to_json() {
        $jadwal = array();

        include("connection.php");
        // nampilin data dari database
        $query = "SELECT * FROM jadwal";
        $hasil = mysqli_query($con, $query);
        
        $i = 1;
        while($row = mysqli_fetch_array($hasil)) {
            $jadwal[] = $row;
        }  
        $file = 'jadwal.json';

        $data = array();
        foreach ($jadwal as $row) {
            $kelas = $row['kelas'];
            $hari = $row['hari'];
            $min = $row['min'];
            $max = $row['max'];
            $matkul = $row['matkul'];
            $dosen = $row['dosen'];
            $ruang = $row['ruang'];
            
            if (!isset($data[$kelas])) {
                $data[$kelas] = array();
            }
            if (!isset($data[$kelas][$hari])) {
                $data[$kelas][$hari] = array();
            }
            $data[$kelas][$hari][] = array(
                'min' => $min,
                'max' => $max,
                'matkul' => $matkul,
                'dosen' => $dosen,
                'ruang' => $ruang
            );
        }

        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $data_jadwal = file_put_contents($file, $jsonfile);
    }

function cekWaktu($n) {
    $slot_waktu = array(
        '07.30',
        '08.20',
        '09.10',
        '10.00',
        '10.15',
        '11.05',
        '11.55',
        '12.45',
        '13.35',
        '14.25',
        '15.15',
        '15.45',
        '16.35',
        '17.25',
        '18.15',
        '18.45',
        '19.35'
    ); 
    

    if($n <= 3) {
        $_SESSION['slot_waktu'] = $slot_waktu[$n - 1] . " - " . $slot_waktu[$n];
    } else if ($n <= 5) {
        $_SESSION['slot_waktu'] = $slot_waktu[$n] . " - " . $slot_waktu[$n + 1];
    } else if ($n <= 8) {
        $_SESSION['slot_waktu'] = $slot_waktu[$n + 1] . " - " . $slot_waktu[$n + 2];
    } else if ($n <= 11) {
        $_SESSION['slot_waktu'] = $slot_waktu[$n + 2] . " - " . $slot_waktu[$n + 3];
    } else {
        $_SESSION['slot_waktu'] = $slot_waktu[$n + 3] . " - " . $slot_waktu[$n + 4];
    }
}
?>