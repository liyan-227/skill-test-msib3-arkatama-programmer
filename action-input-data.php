<?php
//cek button    
    if ($_POST['Submit'] == "Submit") {
    $id    = $_POST['id'];
    $name  = $_POST['name'];
    $age   = $_POST['age'];
    $city  = $_POST['city'];

    echo '<h1>Hasil Input</h1>';
    echo '<ul>';
    echo '<li>Nama: ' . $_POST['name'] . '</li>';
    echo '<li>usia: ' . $_POST['age'] . '</li>';
    echo '<li>Kota: ' . $_POST['city'] . '</li>';
    echo '<li>Jenis Kelamin: ' . (isset($_POST['jenis_kelamin']) ? $jenis_kelamin[$_POST['jenis_kelamin']] : '-') . '</li>';
    
    $list_skill = array();
    foreach ($program as $skill) {
        if ( isset($_POST['skill_' . $skill]) )
        {
            $list_skill[] = $skill;
        }
    }

    echo '<li>Skill: ' . ($list_skill ? join($list_skill, ', ') : '-') . '</li>';
    echo '</ul>';
    //validasi data data kosong
    if (empty($_POST['id'])||empty($_POST['name'])||empty($_POST['city'])||empty($_POST['Age'])) {
        ?>
            <script language="JavaScript">
                alert('Data Harap Dilengkapi!');
                document.location='download-script-form-input-data.php';
            </script>
        <?php
    }
    else {
    include "koneksi-tutor.php";
    //cek NIM di database
    $sql = "INSERT INTO mahasiswa (id,name, age, city) VALUES ($id, $name, $age,$city)";

    if(mysqli_num_rows($sql) == 0){ 
        echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
      }else{ // jika terdapat entri maka tampilkan datanya
        $no = 1; // mewakili data dari nomor 1
        while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
          echo '
          <tr>
            <td>'.$no.'</td>
            <td>'.$name['name'].'</td>
            <td>'.$age['age'].'</td>
            <td>'.$city['city'].'</td>
            <td>Aula</td>
          </tr>
          ';
          $no++; // mewakili data kedua dan seterusnya
        }
    }
    //Masukan data ke Table
    $input    ="INSERT INTO mahasiswa(id,name,age,city) VALUES ('$id','$name','$age','$city')";
    $query_input = mysql_query($input);
    if ($query_input) {
    //Jika Sukses
    ?>
        <script language="JavaScript">
        alert('Input Data Mahasiswa Berhasil');
        document.location='download-script-form-input-data.php';
        </script>
    <?php
    }
    else {
    //Jika Gagal
    echo "Input Data Mahasiswa Gagal!, Silahkan diulangi!";
    }
//Tutup koneksi engine MySQL
    mysql_close($Open);
    }
}
?>
