<?php
class Verification
{

    /**
     * Vérifie si le mail est bien construit
     *
     * @param [string] $mail
     * @return void
     */
    public function verificationMail($phrase)
    {
        $nbPoint = 0;
        $nbHashtag = 0;
        $res = true;

        for ($i = 0; $i < strlen($phrase) and $res; $i++) {
            if ($phrase[$i] == ".") {
                $nbPoint++;
                if ($phrase[$i + 1] == "@" or $phrase[$i + 2] == "@") {
                    $res = false;
                }
            } else if ($phrase[$i] == "@" && ($i + 1) < strlen($phrase) && ($i + 2) < strlen($phrase)) {
                $nbHashtag++;
                if ($phrase[$i + 1] == "." or $phrase[$i + 2] == ".") {
                    $res = false;
                }
            } else if ($i == 0) {
                if ($phrase[$i + 1] == "@" or $phrase[$i + 2] == "@") {
                    $res = false;
                }
            }
        }
        if ($nbPoint >= 1 and $nbHashtag >= 1 and $res = true) {
            return true;
        }
        return false;
    }


    /**
     * Vérifie si le format donné est correct
     *
     * @param [string] $listeArticles
     * @return boolean
     */
    public function verifieListeArticles($articles)
    {
        $pattern = '/^(([0-9]+)_([0-9]+)_([0-9]+),\s?)+$/';
        return preg_match($pattern, $articles);
    }

    public function getArticleFacture($string)
    {
        $string = rtrim($string);
        if (substr($string, -1) == ',') {
            $string = substr($string, 0, -1);
        }
        $array = explode(', ', $string);
        $finalArray = array();
        foreach ($array as $element) {
            $finalArray[] = explode('_', $element);
        }
        return $finalArray;
    }
}
