<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les r�glages de configuration suivants : r�glages MySQL,
 * pr�fixe de table, clefs secr�tes, langue utilis�e, et ABSPATH.
 * Vous pouvez en savoir plus � leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre h�bergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilis� par le script de cr�ation de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas � utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */


// ** R�glages MySQL - Votre h�bergeur doit vous fournir ces informations. ** //
/** Nom de la base de donn�es de WordPress. */
define('DB_NAME', 'obamaelectronique');

/** Utilisateur de la base de donn�es MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de donn�es MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l'h�bergement MySQL. */
define('DB_HOST', 'localhost');


/** Jeu de caract�res � utiliser par la base de donn�es lors de la cr�ation des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de donn�es.
 * N'y touchez que si vous savez ce que vous faites.
 */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par d�faut par des phrases uniques !
 * Vous pouvez g�n�rer des phrases al�atoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secr�tes de WordPress.org}.
 * Vous pouvez modifier ces phrases � n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera �galement tous les utilisateurs � se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');
/**#@-*/

/**
 * Pr�fixe de base de donn�es pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de donn�es
 * si vous leur donnez chacune un pr�fixe unique.
 * N'utilisez que des chiffres, des lettres non-accentu�es, et des caract�res soulign�s!
 */
$table_prefix  = 'wp_';

/**
 * Langue de localisation de WordPress, par d�faut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit �tre install� dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction fran�aise, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et r�glez l'option ci-dessous � "fr_FR".
 */
define('WPLANG', 'fr_FR');

/**
 * Pour les d�veloppeurs : le mode deboguage de WordPress.
 *
 * En passant la valeur suivante � "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommand� que les d�veloppeurs d'extensions et
 * de th�mes se servent de WP_DEBUG dans leur environnement de
 * d�veloppement.
 */
define('WP_DEBUG', false);


define('WP_HOME','http://localhost/Project_Obama/');
define('WP_SITEURL','http://localhost/Project_Obama/');

/* C'est tout, ne touchez pas � ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** R�glage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
/** Identifiant de connexion
 *Login: Obama
 *Password:
 */