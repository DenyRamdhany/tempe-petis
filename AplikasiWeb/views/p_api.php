<?php
  if($enabled) echo json_encode($response,JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
  else { echo "<h3>YOU HAVE NO RIGHTS!</h3>";

?>

  <h3>API Petis v1.0</h3>
  <ul>
    <li>".../api" : Home dari API, isinya dokumentasi ini, sekaligus default page kalo ada yang salah</li>
    <li>".../api/auth/{key}" : Gunakan alamat ini untuk autentikasi pengguna, key tiap pengguna bakal beda-beda</li>
    <li>".../api/auth/{key}/(funct)" : Ini untuk lihat informasi detail pengguna</li>
    <ul>
      <li><b>daftar (funct) :</b></li>
      <li></li>
    </ul>
  </ul>

<?php } ?>
