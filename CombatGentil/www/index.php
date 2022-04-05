<?session_start();

echo"<!DOCTYPE html>
<html>
<head>
<title>Combat gentil de héros et héroïne</title>
<!-- Latest compiled and minified CSS -->
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css' integrity='sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu' crossorigin='anonymous'>

<!-- Optional theme -->
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css' integrity='sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ' crossorigin='anonymous'>

</head>

<body>
<h1>Combat gentil de héros et héroïne</h1>
<section>
<h2>Les règles</h2>";

echo( "<div><p>Première étape, lancez l'instruction SQL se trouvant dans le fichier combatgentil_db.sql.</p>

<p>Deuxième étape, vous devez sélectionner un.e héro ou heroïne en réalisant la bonne requête SQL. 
Vous devez y arriver ou passer votre tour. Donc au afficher toute ses info.</p>");

$j1 = (isset($_POST['Joueur1'])) ? $_POST['Joueur1'] : rand(1,6);
$j2 = (isset($_POST['Joueur2'])) ? $_POST['Joueur2'] : rand(1,6);

echo ("<p>Le joueur 1 aura le héros/heroïne : ID ".$j1."</br>");
echo ("Le joueur 2 aura le héros/heroïne : ID ".$j2."</p>");

echo("<p>Ensuite, à chaque tour vous pouvez faire une action ou tirer une carte pour obtenir une arme ou une compétence.</br> 
Les armes et compétence sont sous forme de requête SQL. À vous de comprendre ce que vous faites.</p>
<p>À chaque requête lancée fausse, vous passez votre tour. Les conséquences peuvent aussi être terribles. Vous pourriez, par exemple, lors de la mauvaise exécution d'une requête, donner l'arme ramassée à l'adversaire.</p>
<p>Lorsque vous tirez une carte, allez donc dans votre PHPMyAdmin pour entrer cette requête. Vous n'êtes pas obligé de la jouer tout de suite. Vous pouvez la conserver pour plus tard et même tenter le combo en lançant plusieurs requêtes de suite !</p></div>
<div><h3>Dans les actions possibles, vous en avez deux :</h3>
<p>UPDATE Heros </br>
SET Heros.ArmeEnMain = </br>
(SELECT Arme.ID FROM Arme, Heros WHERE Arme.HerosID = Heros.ID AND Arme.ID = [X]) </br>
WHERE Heros.ID = [X]</p> </br>
<p>et</p>
<p>UPDATE Heros, Arme </br>
SET Heros.PV = Heros.PV - </br>
(SELECT Arme.Degat + Heros.Bonus FROM Arme, Heros WHERE Arme.ID = Heros.ArmeEnMain AND Heros.ID = [Y]) + </br>
(SELECT Heros.Defense FROM Heros WHERE Heros.ID = [X]) </br>
WHERE Heros.Immunite <> Arme.Type AND Heros.ID = [X]</p>
<p>N'oubliez pas, une action OU une carte ! Et après c'est au joueur suivant.</p></div>
<div><h3>Toutes les requêtes SELECT (Donc pas INSERT, UPDATE, DELETE, etc.) sont gratuites comme :</h3>
<p>SELECT Heros.PV FROM Heros WHERE Heros.ID=[X]</p></div>
<div><h3>Dernier point :</h3>
<p>[X] et [Y] sont les ID que vous devez trouver à mettre. Se sont les seuls valeurs que vous pouvez changer.</p>
<p>Bonne chance et bon gentil combat !!</p></div>
</section>
<section>
<h2> Le jeu :</h2>");

if(!isset($_POST['Carte'])){
    unset($_SESSION['tabCarte']);

    $_SESSION['tabCarte'][] = "INSERT INTO Arme (HerosID, Nom, Type, Degat) VALUES ([X], 'Excalibur', 'Tranchant', 15)";
    $_SESSION['tabCarte'][] = "INSERT INTO Arme (HerosID, Nom, Type, Degat) VALUES ([X], 'Vanne de Liujen', 'Tranchant', 30)";
    $_SESSION['tabCarte'][] = "INSERT INTO Arme (HerosID, Nom, Type, Degat) VALUES ([X], 'L’arc d'Appollon', 'Perçant', 15)";
    //$_SESSION['tabCarte'][] = "INSERT INTO Arme (HerosID, Nom, Type, Degat) VALUES ([X], 'Gant de l’infini', 'Abusé', 5)";
    $_SESSION['tabCarte'][] = "INSERT INTO Arme (HerosID, Nom, Type, Degat) VALUES ([X], 'Microsoft', 'Perçant', 50)";
    $_SESSION['tabCarte'][] = "INSERT INTO Arme (HerosID, Nom, Type, Degat) VALUES ([X], 'Le Caducée', 'Contondant', -20)";
    $_SESSION['tabCarte'][] = "INSERT INTO Arme (HerosID, Nom, Type, Degat) VALUES ([X], 'Mjölnir', 'Contondant', 15)";
    $_SESSION['tabCarte'][] = "INSERT INTO Arme (HerosID, Nom, Type, Degat) VALUES ([X], 'Feuille', 'Tranchant', 5)";
    $_SESSION['tabCarte'][] = "INSERT INTO Arme (HerosID, Nom, Type, Degat) VALUES ([X], 'Caillou', 'Contondant', 5)";
    $_SESSION['tabCarte'][] = "INSERT INTO Arme (HerosID, Nom, Type, Degat) VALUES ([X], 'Ciseau', 'Perçant', 5)";

    $_SESSION['tabCarte'][] = "UPDATE Heros
    SET Heros.ArmeEnMain = 0
    WHERE Heros.ID = [X]

    DELETE FROM Arme
    WHERE Arme.ID = [X]";

    $_SESSION['tabCarte'][] = "UPDATE Heros
    SET Heros.Immunite = 'Aucune'
    WHERE Heros.ID = [X]";

    $_SESSION['tabCarte'][] = "UPDATE Heros
    SET Heros.Immunite = [Texte]
    WHERE Heros.ID = [X]";

    $_SESSION['tabCarte'][] = "UPDATE Heros
    SET Heros.PV =  Heros.PV + 15
    WHERE Heros.ID = [X]";

    $_SESSION['tabCarte'][] = "UPDATE Heros
    SET Heros.PV =  Heros.PV - 10
    WHERE Heros.ID = [X]";

    $_SESSION['tabCarte'][] = "UPDATE Heros
    SET Heros.Defense  =  Heros.Defense  + 5
    WHERE Heros.ID = [X]";

    $_SESSION['tabCarte'][] = "UPDATE Heros
    SET Heros.Defense  =  Heros.Defense  - 2
    WHERE Heros.ID = [X]";

    $_SESSION['tabCarte'][] = "UPDATE Heros
    SET Heros. Bonus =  Heros. Bonus + 5
    WHERE Heros.ID = [X]";

    $_SESSION['tabCarte'][] = "UPDATE Heros
    SET Heros.Bonus =  Heros. Bonus - 10 
    WHERE Heros.ID = [X]";

    $_SESSION['tabCarte'][] = "Vous avez le droit d'écrire votre propre requête";
}

if((isset($_POST['Carte']) && (count($_SESSION['tabCarte'])>1))){
    echo "<div><p>Carte tirée : ".$_POST['ValueCard'];
    unset($_SESSION['tabCarte'][$_POST['NoCarte']]);
    echo "<br>Il ne reste plus que ".count($_SESSION['tabCarte'])." carte(s)";
    $carteTiree = array_rand($_SESSION['tabCarte']);
}elseif (isset($_POST['Carte'])){
    echo "<div><p>Plus de carte !";
}else{
    echo "<div><p>Pour tirer une carte :</br>";
    $carteTiree = array_rand($_SESSION['tabCarte']);
}

echo "</p></div>
<div>";

?>
<form method="post">       
    <input type="submit" name="Carte" value="Carte" />
    <input type="hidden" name="ValueCard" value="<?echo $_SESSION['tabCarte'][$carteTiree];?>"/>
    <input type="hidden" name="Joueur1" value="<?echo $j1;?>"/>
    <input type="hidden" name="Joueur2" value="<?echo $j2;?>"/>
    <input type="hidden" name="NoCarte" value="<?echo $carteTiree;?>"/>
</form>
<?php
echo "</div>
</section>
<!-- Latest compiled and minified JavaScript -->
<script src='https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js' integrity='sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd' crossorigin='anonymous'></script>
</body>
</html>";
