<?php
//insert.php  

$connect = mysqli_connect("localhost", "root", "", "test");
if(!empty($_POST))
{
 $output = '';
 $nom= mysqli_real_escape_string($connect, $_POST["nom"]);  
    $prenom = mysqli_real_escape_string($connect, $_POST["prenom"]);  
    $categorie = mysqli_real_escape_string($connect, $_POST["categorie"]);  





    
   
    $query = "
    INSERT INTO contact(nom, prenom, categorie)  
     VALUES('$nom', '$prenom', '$categorie')
    ";
    if(mysqli_query($connect, $query))
    {
     $output .= '<label class="text-success">Donnée insérée</label>';
     $select_query = "SELECT * FROM contact,categorie where  contact.categorie= categorie.id";
     $result = mysqli_query($connect, $select_query);
     $output .= '
      <table class="table table-bordered">  
                    <tr>  
                        <th width="20%">Nom</th>  
                        <th width="20%">Prenom</th> 
                        <th width="30%">Categorie</th>   
                         <th width="30%">Editer</th>  
                    </tr>

     ';
     while($row = mysqli_fetch_array($result))
     {
      $output .= '
       <tr>  
                         <td>' . $row["nom"] . '</td>  
                         <td>' . $row["prenom"] . '</td> 
                         <td>' . $row["libelle"] . '</td> 
                         <td><input type="button" name="view" value="modifier" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
                    </tr>
      ';
     }
     $output .= '</table>';
    }
    echo $output;
}


if(!empty($_POST))  
{  
     $output = '';  
     $message = '';  
     $nom= mysqli_real_escape_string($connect, $_POST["nom"]);  
    $prenom = mysqli_real_escape_string($connect, $_POST["prenom"]);  
    $categorie = mysqli_real_escape_string($connect, $_POST["categorie"]);  

     if($_POST["e_id"] != '')  
     {  
          $query = "  
          UPDATE contact  
          SET nom='$name',   
          prenom='$^prenom',   
         categorie='$categorie',   
          
          WHERE id='".$_POST["e_id"]."'";  
          $message = 'Donnée modifiée';  
     }  
     else  
     {  
          $query = "  
          INSERT INTO contact(nom, prenom, categorie)  
          VALUES('$nom', '$prenom', '$categorie');  
          ";  
          $message = 'Donnée inserée';  
     }  
     if(mysqli_query($connect, $query))  
     {  
          $output .= '<label class="text-success">' . $message . '</label>';  
          $select_query = "SELECT * FROM contact";  
          $result = mysqli_query($connect, $select_query);  
          $output .= '  
               <table class="table table-bordered">  
                    <tr>  
                    <th width="20%">Nom</th>  
                    <th width="20%">Prenom</th> 
                    <th width="30%">Categorie</th>   
                     <th width="30%">Modifier</th>  
                    </tr>  
          ';  
          while($row = mysqli_fetch_array($result))  
          {  
               $output .= '  
                    <tr  type="button" name="view" value="modifier" id="<?php echo $row["id"]; ?>" class="view_data">
                         <td>' . $row["nom"] . '</td>  
                         <td>' . $row["prenom"] . '</td>  
                         <td>' . $row["categorie"] . '</td>  
                         <td><input type="button" name="view" value="Modifier" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" /></td>  
                         
                    </tr>  
               ';  
          }  
          $output .= '</table>';  
     }  
     echo $output;  
}  


?>
