<?php
        //Test script pour créer les articles en fonction de la base de donnée

        ConnexionDB::getInstance();
        $sql = "SELECT id FROM product";
        $result = ConnexionDB::getInstance()->querySelect($sql);
        $nbProduct = count($result);

        #mettre du html
        for ($i = 1; $i <= $nbProduct; $i++) {
            $nom = "SELECT nom FROM product WHERE id = $i";
            $result = ConnexionDB::getInstance()->querySelect($nom);

            if ($i % 2 == 1) {
                echo "<tr>";
            }
            else{
                echo "</tr>";
            }
            
            echo "<td> $nom </td>";
        }
            
        


    






?>