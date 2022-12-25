<?php
    session_start();
    $GLOBALS["page"] = "articles.php";
    require_once('index.php');
    require_once('database/Database.php');
?>

<!DOCTYPE html>
<html LANG="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Magasin Virtuel</title>
</head>
<body>
    <main>
        <h1>Articles</h1>
        <div class = "article">
        <table>
            <tbody>
                <?php
                    ConnexionDB::getInstance();
                    $sql = "SELECT id FROM produit";
                    $result = ConnexionDB::getInstance()->querySelect($sql);
                    $nbProduct = count($result);
            
                    for ($i = 1; $i <= $nbProduct; $i++) {
                        $nom = "SELECT nom FROM produit WHERE id = $i";
                        $result = ConnexionDB::getInstance()->querySelect($nom);
            
                        if ($i % 2 == 1) {
                            echo "<tr>";
                        }  

                        $nomProduit = $result[0]["nom"];
                        $img = "SELECT image FROM produit WHERE id = $i";
                        $res2 = ConnexionDB::getInstance()->querySelect($img);
                        //print_r($res2[0]['image']);
                        //$_SESSION[$nomProduit] = 0;
                        $link = "img/".$res2[0]['image'];
                        //echo $link;
                        echo '<td> '; echo "<img src=$link>" ; echo '<p>'; echo $result[0]["nom"]; echo '</p>';
                        echo '<br>';
                        ?>

                            <script> let nb = 0; </script> 
                            <p id="valeur">Valeur : <span id="chiffre">0</span></p>
                            <button onclick="incrementer()"> <img src="img/symboleMoins.png" id = "imageQuantiteMoins"> </button>
                            <button onclick="incrementer()"> <img src="img/symbolePlus.png" id = "imageQuantitePlus"> </button> 
                        </td>
                        <?php
                        echo '<style>
                            #imageQuantiteMoins{
                                width: 20px;
                                height: 20px;
                            }
                            #imageQuantitePlus{
                                width: 20px;
                                height: 20px;
                            }
                            td {
                                text-align: center;
                                display: inline-block;
                            }

                            button {
                                border: none;
                                background-color: white;
                            }

                            '
                            ;
            
                        if($i % 2 == 0){
                            echo "</tr>";
                        }
                    }

                    
?>
                <tr>
                    <td>article1</td>
                    <td>article2</td>
                </tr>
            </tbody>
        </table>
        </div>

        <script>
  function incrementer() {
    nb += 1;
    // Mise à jour de la valeur dans le document
    document.getElementById('chiffre').innerHTML = nb;
  }
</script>
    </main>
    
    <footer>
        <p>Développé par <a href="mailto:alexis.rosset@etu.univ-cotedazur.fr">Alexis Rosset</a> et <a href="mailto:leo.quelis@etu.univ-cotedazur.fr">Léo Quelis</a> - 2022-2023</p>
    </footer>
</body>
</html>