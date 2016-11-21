<?php
/*
@package WordPress
@subpackage Clean
@author Bruno Bichet <bruno.bichet@gmail.com>
@version 1
@since Version 0.1
*/

/*
Note:
By using this child theme functions.php file (see http://codex.wordpress.org/Theme_Development and
http://codex.wordpress.org/Child_Themes), you can override the original functions
wrapped in a if function_exists() condition by defining them first here.
*/

/*
TOC:
1. basics_current_category_link()		Display a link to the category which shows more posts from the featured post
2. basics_current_category()				Add the categories to avoid duplicate titles when displaying a post within several categories
3. remove_width_attribute() 				Remove the Width and Height Attributes From WP Image Uploader
4. basics_get_quotes_about_design 	Get a random quote about design among list.
5. basics_quotes_about_design()			Display a random quote about design.
6. basics_more_current_category()		Return the current category name of the featured post (home.php).
7. basics_post_modified_on()				Return the modified date of the post
8. basics_archives_link()           Return a link to the archives.php template
*/

/**
 * 1. Display a link to the category which shows more posts from the featured post (mainly used within home.php)
 */
function basics_current_category_link() {
	global $args;
	//global $post;
	$current_category = get_the_category();
	/*$current_category = $current_category[0]->term_id;
	$current_category_slug = $current_category[0]->category_name;*/
	$link = sprintf( __( '<a href="%1$s" title="%2$s %3$s">%2$s <strong>%3$s</strong> &#8599;</a>', 'basics' ),
	esc_url( get_category_link( $current_category[0]->term_id ) ),
	__( 'Read all posts about', 'basics' ),
	$current_category[0]->cat_name
	);
	return $link;

	//echo '<a href="'.get_category_link($current_category[0]->term_id ).'">'.$current_category[0]->cat_name.'</a>';
}

/**
 * 2. Add the categories to avoid duplicate titles when displaying a post within several categories
 */
function basics_current_category() {
	global $args;
	$current_category = get_the_category();
	foreach(( $current_category ) as $cat) {
			echo $cat->cat_name . ' ';
	}
	return $cat;
}

/**
 * 3. Remove the Width and Height Attributes From WP Image Uploader
 */
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

/**
 * 4. Get a random quote about design.
 */
function basics_get_quotes_about_design() {
	/** These are the quotes */
	$quotes = "Un bon designer n’a pas toutes les réponses, mais pose les bonnes questions —&nbsp;Rudy Duke
L’art naît de contraintes, vit de luttes et meurt de liberté —&nbsp;André Gide
« C’est beau » est le pire commentaire à faire à propos d’un design —&nbsp;Whitney Hess
Si vous pouviez le dire avec des mots, vous n’auriez pas à le peindre —&nbsp;Edward Hopper
La lumière est la seule réalité —&nbsp;Robert Delaunay
Le design n’est pas seulement l’apparence, c’est aussi la manière de fonctionner —&nbsp;Steve Jobs
N’essayez pas d’être original, contentez-vous d’être bon —&nbsp;Paul Rand
Personne n’a jamais rien découvert en dessinant à l’intérieur des lignes —&nbsp;Thomas Vasquez
Non Watson, ceci n'est pas arrivé par accident, mais par dessein —&nbsp;Sherlock Holmes
La simplicité est la sophistication ultime —&nbsp;Léonard de Vinci
L’art commence où finit la géométrie —&nbsp;Paul Standard
Je trouve des solutions dont personne ne veut à des problèmes qui n'existent pas —&nbsp;Alvin Lustig
Si le bon design se remarque, le grand design passe inaperçu —&nbsp;Wim Hovens
N’attendez pas l'idée géniale pour commencer à travailler&nbsp;: <br />elle viendra en travaillant —&nbsp;Josh Collinsworth
C’est très facile d’être différent, mais très difficile d’être meilleur —&nbsp;Jonathan Ive
La perfection est atteinte, non pas lorsqu’il n’y a plus rien à ajouter, <br />mais lorsqu’il n'y a plus rien à retirer —&nbsp;Antoine de Saint-Exupéry
La simplicité consiste à enlever l’évidence et à ajouter du sens ―&nbsp;John Maeda
Les trois fonctions du graphisme sont : identifier, informer et promouvoir ―&nbsp;Le Graphisme au XXe siècle
Contrairement à l’artiste, le graphiste travaille en vue <br />d’une reproduction industrielle ―&nbsp;Le Graphisme au XXe siècle
Les imprimeurs du moyen-âge réutilisaient déjà à volonté <br />les illustrations gravées sur bois ―&nbsp;Le Graphisme au XXe siècle
Les biscuits Bahlsen, le café Hag et les encres Pelikan furent parmi les premiers <br />à adopter l’idée d’une image de marque ―&nbsp;Le Graphisme au XXe siècle
Le métier de graphiste date du milieu du XXe siècle ―&nbsp;Le Graphisme au XXe siècle
Après la révolution de 1917, les arts graphiques devinrent un outil <br />de communication de masse ―&nbsp;Le Graphisme au XXe siècle
Le style moderne internationale survécut au nazisme pour réapparaitre dans les années 1960 <br />sous le nom de «style suisse» ―&nbsp;Le Graphisme au XXe siècle
Quand la simple énumération des faits est laborieuse, <br />il faut faire appel au graphisme ―&nbsp;Le Graphisme au XXe siècle
En 1957, le caractère sans sérif Neue Haas (rebaptisé Helvetica) devint incontournable <br />pour les graphistes «constructivistes» des années 1950 et 1960 ―&nbsp;Le Graphisme au XXe siècle
Le graphiste est celui qui est capable de résoudre les problèmes de communication, <br />quel que soit le médium imposé ―&nbsp;Ashley Havinden
Le Bauhaus a commis deux erreurs : le rejet de toute mise en page centrée <br />et l’utilisation exclusive de linéales ―&nbsp;Jan Tschichold";
	$quotes = explode( "\n", $quotes );
	return wptexturize( $quotes[ mt_rand( 0, count( $quotes ) - 1 ) ] );
}

/**
 * 5. Display a random quote about design.
 */
function basics_quotes_about_design() {
	$chosen = basics_get_quotes_about_design();
	return $chosen;
}

/**
 * 6. Return the current category name of the featured post (home.php).
 */
function basics_more_current_category() {
	global $args;
	$current_category = get_the_category();
	$current_category = $current_category[0]->cat_name;
	return $current_category;
}

/**
 * 7. Return the modified date of the post
 */
function basics_post_modified_on() {
	if( get_the_modified_time('Gi') - get_the_time('Gi') > 0 ) {
	echo '<span class="post-modified-on">';
  $modified_date = sprintf(
  	_e( 'Updated on: ' ),
  	the_modified_date()
  );
	echo '</span>';
	}
	return $modified_date;
}

/**
 * 8. Display a link to the archives.php template
 */
function basics_archives_link() {
  $archives_link = sprintf(
    '<a href="%1$s" title="%2$s">%2$s</a>',
    __('/archives'),
  	__( 'Read all the posts published on <strong>4design</strong> &#8599;', 'basics' )
  );
		return $archives_link;
}