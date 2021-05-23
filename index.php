<?php  
//index.php
$connect = mysqli_connect("localhost", "root", "", "test");
$query = "SELECT * FROM contact,categorie where contact.categorie= categorie.id";
$query1 = "SELECT * FROM categorie";
$result = mysqli_query($connect, $query);
$result1 = mysqli_query($connect, $query1);
 ?>  
<!DOCTYPE html>  
<html>  
 <head>  
  <title>test</title>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
 </head>  
 <body>  
  <br /><br />  
  <div class="container" style="width:700px;">  
   <h3 align="center">Liste des contacts</h3>  
   <br />  
   <div class="table-responsive">
    <div align="right">
    <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary">Ajouter</button>
    
    </div>
    <br />
    <div id="employee_table">
     <table class="table table-bordered">
      <tr>
       <th width="70%">Nom</th>  
       <th width="30%">Prenom</th>
       <th width="30%">Categorie</th>
       <th width="30%">Modifier</th>
      </tr>
      <?php
      while($row = mysqli_fetch_array($result))
      {
      ?>
      <tr  type="button" name="view" value="modifier" id="<?php echo $row["id"]; ?>" class="view_data">
       <td><?php echo $row["nom"]; ?></td>
       <td><?php echo $row["prenom"]; ?></td>
       <td><?php echo $row["libelle"]; ?></td>
       <td><input type="button" name="view" value="modifier" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" /></td>

      </tr>
 
       
       
      
      
       
      </tr>
      <?php
      }
      ?>
     </table>
    </div>
   </div>  
  </div>
 </body>  
</html>  

<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Formulaire d'ajout</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="insert_form">
     <label>Entrer le nom</label>
     <input type="text" name="nom" id="nom" class="form-control" />
     <br />
     <label>Entrer le prenom</label>
     <input name="prenom" id="prenom" class="form-control"/>
     <br />
     <label>Selectionner une categorie</label>
     <select name="categorie" id="categorie" class="form-control">
     <?php
      while($row1 = mysqli_fetch_array($result1))
      {
      ?>
    
     <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["libelle"]; ?></option>
            
     
      <?php
      }
      ?>
      <option value=""><?php echo $row1["categorie"]; ?></option>  
      
     </select>
     <br />  
    
     <input type="hidden" name="e_id" id="e_id" /> 
     <input type="submit" name="insert" id="insert" value="Ajouter" class="btn btn-success" />

    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
   </div>
  </div>
 </div>
</div>


















<div id="dataModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Modierfier un contact</h4>
   </div>
   <div class="modal-body" id="employee_detail">
    
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>

<script>  
$(document).ready(function(){
 $('#insert_form').on("submit", function(event){  
  event.preventDefault();  
  if($('#nom').val() == "")  
  {  
   alert("Nom est obligatoire");  
  }  
  else if($('#prenom').val() == '')  
  {  
   alert("Prenom est obligatoire");  
  }  
  else if($('#categorie').val() == '')
  {  
   alert("categorie est obligatoire");  
  }
   
  else  
  {  
   $.ajax({  
    url:"ajax.php",  
    method:"POST",  
    data:$('#insert_form').serialize(),  
    beforeSend:function(){  
     $('#insert').val("Insertion");  
    },  
    success:function(data){  
     $('#insert_form')[0].reset();  
     $('#add_data_Modal').modal('hide');  
     $('#employee_table').html(data);  
    }  
   });  
  }  
 });




 $(document).on('click', '.view_data', function(){
  //$('#dataModal').modal();
  var e_id = $(this).attr("id");
  $.ajax({
   url:"./libs/select.php",
   method:"POST",
   data:{e_id:e_id},
   success:function(data){
    $('#employee_detail').html(data);
    $('#dataModal').modal('show');
   }
  });
 });
});  
 </script>
