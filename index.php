<!DOCTYPE html>
<html lang="en">
  <head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=,, initial-scale=1.0">
       <title>Document</title>
       <!-- CSS only -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
       <!-- JavaScript Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
     <style>
      thead td{
        color:white;
      }
     </style>
    </head>
    <body>
        <div class="container mt-5">
          <form method="POST" action="index.php">
                <div class="form-group">
                  <label for="isim">İsim:</label>
                  <input class="form-control" type="text" name="isim" id="isim" placeholder="isim giriniz">
                  <label   for="soyisim">Soyisim:</label>
                  <input  class="form-control" type="text" name="soyisim" id="soyisim" placeholder="soyisim giriniz">
                  <label for="tel">Telefon:</label>
                  <input  class="form-control" type="text" name="tel" id="tel" placeholder="telefon numarası giriniz"> <br>
                  <input  class="btn btn-primary" type="submit" name="gonder" id="gonder"> 
               </div>
          </form>
       </div>
         <?php 
       include 'connect.php';
            //gonder tuşuna basılmışsa
            if(isset($_POST['gonder']))
            {
              $isim=$_POST['isim'];
              $soyisim=$_POST['soyisim']; 
              $tel=$_POST['tel'];
   
                //boş veri gönderilmişse
                if(empty($isim)||empty($soyisim)||empty($tel))
                {?>
                    <div class="alert alert-danger container mt-3" >Lütfen alanları doldurunuz!</div>
                   <?php            
                }   
                //tüm alanlar doldurulmuş ise
                else
                {                
                    //veritabanına ekleme              
                   $sql = "INSERT INTO uyeler (isim, soyisim, telefon)
                   VALUES ('$isim', '$soyisim', '$tel');"; 
                   if ($baglanti->multi_query($sql) === TRUE) 
                   {                        
                   } 
                   else  
                   {
                   echo "Error: " . $sql . "<br>" . $baglanti->error;
                   }        
                }
            }

            // veri tabanından çekme
            $secme = "SELECT id, isim, soyisim,telefon FROM uyeler";
            $dizi = $baglanti->query($secme);
            if ($dizi->num_rows > 0) 
            {                
              ?>                           
              <div class="container mt-5">
                    <table class="table table-striped table-hover">
                        <thead class="bg-dark">
                            <tr>
                              <td>ID</td>
                              <td>İsim</td>
                              <td>Soyisim</td>
                              <td>Telefon</td>
                              <td>Sil</td>                             
                            </tr>
                        </thead>
                        <tbody>
                                    <?php
                                       while($row = $dizi->fetch_assoc()) 
                                       {
                                           $ID=$row['id'];                                       
                                    ?>
                            <tr>
                               <td> <?php echo $row['id']; ?> </td>
                               <td> <?php echo $row['isim'];?></td>
                               <td> <?php echo $row['soyisim']; ?></td>
                               <td> <?php echo $row['telefon'];?></td>
                              
                               <td> <a href="sil.php?urunsil&id=<?php echo $ID?>"><button name="sil" type="button" class="btn btn-danger">Sil</button></a></td>
                             </form> 
                           </tr>
                                    <?php
                                     }
                                    ?>
                        </tbody>
                    </table>
            </div>
            <?php            
} else {
}
        ?>
        <?php
        ?>
    </body>
</html>
