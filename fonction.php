<!--page des fonctions cree dans le projet  -->

<?php

/*fonction qui vérifie que l'utilisateur existe déja  */

if(!function_exists('is_already_in_use')){


	function is_already_in_use($field,$value,$table){

	
		global $bdd;

		$req=$bdd->prepare("SELECT idAbonne from $table where $field=?");
       $req->execute([$value]);	

       $count = $req->rowCount();

       $req->closeCursor();

       return $count;
	}
}

/*garde les infos du formulaire aprs une saisie errone  */

if(!function_exists('save_input_data')){

function save_input_data(){

	foreach ($_POST as $key => $value) {
		if(strpos($key, 'password')===false){


		$_SESSION['input'][$key]=$value;
		}

	}

}

}


/*fonction qui permet de maintenir foncé le lien active dans la barre de navigation (je ne l'ai pas encore mis en pratique...lol) */

if(!function_exists('get_input')){

function get_input($key){

	

		if(!empty($_SESSION['input'][$key])){
			
		return e($_SESSION['input'][$key]);
		}
		else
		{
			return null;
		}
}

}

/*fonction qui permet d'enlever les infos retenu en réactualisant la page (je ne l'ai pas encore mis en pratique...lol) */

if(!function_exists('clear_input_data')){

function clear_input_data(){

if(isset($_SESSION['input'])){
			
		$_SESSION['input']=[];

		}
	} 
		
}



if(!function_exists('e')){


	function e($string){

	if($string){

		return strip_tags($string);
	}
	}
}

/*if(!function_exists('set_active')){

	function set_active($file, $class='active'){

	$page=array_pop(explode('/',$_SERVER['SCRIPT_NAME']));

		if($page==$file.'.php'){

			return $class;
		}else
		{
			return "";
		}
	}
	}
*/


	//gat_avatar url

/*if(!function_exists('get_avatar_url')){

	function get_avatar_url($email,$size=25){

		return "http://gravatar.com/avatar/".md5(strtolower(trim(e($email))))."?s=".$size.'&d=mm';
}

*/


?>


<?php



//le fonction prend comme parametre la longueur de la taille que tu veut generer fr
function genere_chaine($long){

    //Ici j ai declarer une liste des caractere qui seront utilisé pour generer notre texte
    $alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    //la fonction renvoi un melange de caractere de facon aleatoir en fonction de la longeur defini
    return substr( str_shuffle(str_repeat($alphabet, $long)), 0, $long);
    }



//Teste le la fonctino

$chaine = genere_chaine(45);


//Regarde le resultat fr
/*echo($chaine);*/



?>