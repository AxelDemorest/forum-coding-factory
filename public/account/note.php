<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../header/header.css" rel="stylesheet" />
    <link href="../footer/footer.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="note.css">

    <title>Pages Note </title>


</head>
<body>
   

    <!-- -------------------------------- -->   
    
    <?php session_start();

    include "../header/header.php"; ?>

    <!-- Tu peux coder ici -->

   
    <?php
    
        if(isset($_GET['note']) AND isset($_GET['eleve']))
        {
            echo $_GET['note'];
            echo $_GET['eleve'];
        }
        
    ?>

<div class="matiere">   

<table>
    <thead>
        <tr>
            <th colspan="6">Choisir sa matière </th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td colspan="2"> <button>HTML/CSS</button></td>
            <td colspan="2"> <button>Python</button></td>
            <td colspan="2"> <button>JavaScript</button></td>
            <td colspan="2"> <button>Java</button></td>
            <td colspan="2"> <button>PHP</button></td>
            <td colspan="2"> <button>JavaScriptAvancer</button></td>
            <td colspan="2"> <button>JavaAvancer</button></td>
            <td colspan="2"> <button>Labday</button></td>
            <td colspan="2"> <button>Anglais</button></td>
            <td colspan="2"> <button>PojetWeb</button></td>
            <td colspan="2"> <button>agil</button></td>



        </tr>
    </tbody>

</table>
</div>





<div class="tableauNote "> 
     <table>
            <tread>
                <tr>
                    <th colspan="2">Note de l'élève :</th>
                    <th colspan="2">Commentaire :</th>
                    <th colspan="2">Moyenne de classe  :</th>

                </tr>
            </tread>
        <tbody>

            <tr>
                <td colspan="2" > <input type="text" name="valeur" placeholder="Note de l'élève"/>  </td>
                <td colspan="2">  <input type="text" name="commentaire" placeholder="Commentaire"/> </td>
                <td colspan="2">  <input type="text" name="moyenne" placeholder="Moyenne de classe"/> </td>
            </tr>

            <tr>
                <td colspan="2" > <input type="text" name="valeur" placeholder="Note de l'élève"/>  </td>
                <td colspan="2">  <input type="text" name="commentaire" placeholder="Commentaire"/> </td>
                <td colspan="2">  <input type="text" name="moyenne" placeholder="Moyenne de classe"/> </td>
            </tr>

            <tr>
                <td colspan="2" > <input type="text" name="valeur" placeholder="Note de l'élève"/>  </td>
                <td colspan="2">  <input type="text" name="commentaire" placeholder="Commentaire"/> </td>
                <td colspan="2">  <input type="text" name="moyenne" placeholder="Moyenne de classe"/> </td>
            </tr>
        </tbody>
          
     </table>
     <button >Valider</button>
</div>


    <!-- Footer -->
    <?php include "../footer/footer.html"; ?>

    <!-- Javascript -->
    <script src="../../header/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>