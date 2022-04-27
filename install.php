<?php
    $host = $_POST["host"];
    $username = $_POST["username"];
    $password = $_POST["password"];
  //echo ($host." ".$username." ".$password);
    $conn = new mysqli($host,$username,$password);
  
  if($conn->connect_error)
  {
    //echo "KO";
    die("La connexion à la base de données à échouée !" . $conn->connect_error()); 
  }
  else
    {
    //echo "OK";
    //$sql = "CREATE DATABASE hypnos";
    //if($conn->query($sql)== TRUE )
    //{   
      //echo "La base de données a été créée avec succès...";
    //}
    $script = "sql_hypnos.sql"; 
    $contenuScript = file_get_contents($script); 
    $tab = explode(";",$contenuScript); # on coupe le contenu du fichier en petit morceau avec le délimiteur ";" 
    $sql = $tab[0]; # on récupère le contenu du script la ligne 0 qui correspond à la création de la base de données 
    $conn->query($sql);
    
    $conn = new mysqli($host, $username, $password, "hypnos");
    $tailleTab = count($tab); 
    unset($tab[$tailleTab-1]); # on enlève la dernière valeur qui correspond à rien 
    $tailleTab = count($tab);
    $i=1; // on initialise à 1 car 0 correspond à la création 
    while($i < $tailleTab){
        $conn->query($tab[$i]);
        $i+=1;
    }
    echo "La base de données a été créée avec succès... Merci de supprimer les fichiers index.html et install.php";
    header("Refresh:8;url=index.php");
  }
  
    ?>