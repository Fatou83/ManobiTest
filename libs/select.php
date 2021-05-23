<?php  
//select.php  
if(isset($_POST["e_id"]))
{
 $output = '';
 $connect = mysqli_connect("localhost", "root", "", "test");
 $query = "SELECT * FROM contact WHERE   id = '".$_POST["e_id"]."'";

 $query1 = "SELECT * FROM categorie,contact WHERE contact.categorie= categorie.id ";

$result1 = mysqli_query($connect, $query1);
 $result = mysqli_query($connect, $query);
 $output .= '  

 







      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '

     <form method="post" id="insert_form">
     <label>Entrer le nom</label>
     <input type="text" name="nom" id="nom" class="form-control" value='.$row["nom"].' />
     <br />
     <label>Entrer le prenom</label>
     <input name="prenom" id="prenom" class="form-control"   value='.$row["prenom"].' />
     <br />
     <label>Selectionner une categorie</label>
     <input name="categorie" id="categorie" class="form-control" value='.$row["categorie"].' />
     
    
     
     <br />  
    
     
     <input type="submit" name="insert" id="insert" value="Modifier" class="btn btn-success" />

    </form>
        
     ';
    }
    $output .= '</table></div>';
    echo $output;
}
?>
