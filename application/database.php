<?php
class database
{

    var $host = "localhost";
    var $username = "root";
    var $password = "dbhoicel2022";
    var $database = "hexagon";
    var $koneksi = "";
    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        } else {
            echo "berhasil!";
        }
    }

    function get_data()
    {
        $data = mysqli_query($this->koneksi, "select * from control");
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = [
                'chip_id' => $row['chip_id'],
                'nilai' => $row['nilai']
            ];
        }
        return $hasil;
    }
    function update_control($data)
    {

        foreach ($data as $d => $v) {
            mysqli_query($this->koneksi, "UPDATE data_sensor SET nilai = '" . $v['nilai'] . "', created_at = '" . $v['created_at'] . "'  WHERE mesin ='" . $v['mesin'] . "' ");
        }
    }
}
