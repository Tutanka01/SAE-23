<?php
$db = new Sqlite3('C:\Users\uppa\Documents\SAE-23\sqlite.sqlite');
$query=mysql_query('SELECT date,temperature FROM data_meteo ORDER BY date ASC');
$results = $db->query($sql);

$date=array();
$temp=array();
$i=0;
while($row = $results->Fetcharray())
{
    //Mettre la ligne dans le tableau
	$date[$i]=$row["date"];
    $temp[$i]=$row["temperature"];
    //Prendre la première masse comme minimum et maximum
    if($i==0)
		{
			$min=$row["temperature"];
			$max=$row["temperature"];
		}
    //Tester si la masse est inférieur au minimum et le prendre si il l'est
    if($row["temperature"] < $min)
		{
			$min=$row["temperature"];
		}
    //Tester si la masse est inférieur au maximum et le prendre si il l'est
    else
		{
			if($row["temperature"] > $max)
			 {
			 	$max=$row["temperature"];
			}
		}
//	echo $date[$i]." - ".$masse[$i]."<br>";
    $i++;
	
}
//echo "min : ".$min."   -   max : ".$max;


//Type mime de l'image
header('Content-type: image/png');
//Chemin vers le police à utiliser
$font_file = './arial.ttf';
//Adapter la largeur de l'image avec le nombre de donnée
$largeur=$i*50+90;
$hauteur=400;
//Hauteur de l'abscisse par rapport au bas de l'image
$absis=80;
//Création de l'image
$courbe=imagecreatetruecolor($largeur, $hauteur);
//Allouer les couleurs à utiliser
$bleu=imagecolorallocate($courbe, 0, 0, 255);
$ligne=imagecolorallocate($courbe, 220, 220, 220);
$fond=imagecolorallocate($courbe, 250, 250, 250);
$noir=imagecolorallocate($courbe, 0, 0, 0);
$rouge=imagecolorallocate($courbe, 255, 0, 0);
//Colorier le fond
imagefilledrectangle($courbe,0 , 0, $largeur, $hauteur, $fond);
//Tracer l'axe des abscisses
imageline($courbe, 50, $hauteur-$absis, $largeur-10,$hauteur-$absis, $noir);
//Tracer l'axe des ordonnées
imageline($courbe, 50,$hauteur-$absis,50,20, $noir);
//Decaler 10px vers le haut le si le minimum est différent de 0
if($min!=0)
{
    $absis+=10;
    $a=10;
}
//Nombres des grides verticales
$nbOrdonne=10;
//Calcul de l'echelle des abscisses
$echelleX=($largeur-100)/$i;
//Calcul de l'echelle des ordonnees
$echelleY=($hauteur-$absis-20)/$nbOrdonne;
$i=$min;
//Calcul des ordonnees des grides
$py=($max-$min)/$nbOrdonne;
$pasY=$absis;
while($pasY<($hauteur-19))
{
    //Affiche la valeur de l'ordonnee
    imagestring($courbe, 2,10 , $hauteur-$pasY-6, round($i), $noir);
    //Trace la gride
    imageline($courbe, 50, $hauteur-$pasY, $largeur-20,$hauteur-$pasY, $ligne);
    //Decaller vers le haut pour la prochaine gride
    $pasY+=$echelleY;
    //Valeur de l'ordonnee suivante
    $i+=$py;
}


$j=-1;
 //Position du première jour de production
 $pasX=90;
 //Parcourir le tableau pour le traçage du diagramme
 foreach ($temperature as $jour => $quantite) {
   //calculer la hateur du point par rapport à sa valeur
   $y=($hauteur) -(($quantite -$min) * ($echelleY/$py))-$absis;
   //dessiner le point
   imagefilledellipse($courbe, $pasX, $y, 6, 6, $rouge);
   //Afficher le mois en français avec une inclinaison de 315°
   imagefttext($courbe, 10, 315, $pasX, $hauteur-$absis+20, $noir, $font_file, $date[$jour]);
   //Tacer une ligne veticale de l'axe de l'abscisse vers le point
   //imageline($courbe, $pasX, $hauteur-$absis+$a, $pasX,$y, $noir);
   if($j!==-1)
    {
      //liée le point actuel avec le précédent
      imageline($courbe,($pasX-$echelleX),$yprev,$pasX,$y,$noir);
    }
    //Afficher la valeur au dessus du point
   imagestring($courbe, 2, $pasX-15,$y-14 , $quantite, $bleu);
   $j=$quantite;
   //enregister la hauteur du point actuel pour la liaison avec la suivante
   $yprev=$y;
   //Decaller l'abscisse suivante par rapport à son echelle
   $pasX+=$echelleX;
}
//Envoyer le flux de l'image
imagepng($courbe);
//Desallouer le memoire utiliser par l'image
imagedestroy($courbe);
?>