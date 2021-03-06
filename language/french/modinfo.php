<?php
//  ------------------------------------------------------------------------ //
//                      MYJOB - MODULE FOR XOOPS 2.0.x                       //
//                  Copyright (c) 2005-2006 Instant Zero                     //
//                     <http://www.instant-zero.com/>                        //
// ------------------------------------------------------------------------- //
//  This program is NOT free software; you can NOT redistribute it and/or    //
//  modify without my assent.                                                //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed WITHOUT ANY WARRANTY; without even the       //
//  implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. //
//                                                                           //
//  ------------------------------------------------------------------------ //

define('_MI_MYJOB_NAME', 'myjobs');
define('_MI_MYJOB_DESC', "Module permettant la gestion d'offres et de demandes d'emploi");

define('_MI_MYJOB_ADMMENU1', "Offres d'emploi");
define('_MI_MYJOB_ADMMENU2', "Demandes d'emploi");
define('_MI_MYJOB_ADMMENU3', 'Situations de famille');
define('_MI_MYJOB_ADMMENU4', 'Types de postes');
define('_MI_MYJOB_ADMMENU5', 'Permissions');
define('_MI_MYJOB_ADMMENU6', 'Zones géographiques');
define('_MI_MYJOB_ADMMENU7', "Secteurs d'activité");
define('_MI_MYJOB_ADMMENU8', 'Rémunération');
define('_MI_MYJOB_ADMMENU9', 'Purge');
define('_MI_MYJOB_ADMMENU10', 'Champs');
define('_MI_MYJOB_ADMMENU11', 'Expérience');
define('_MI_MYJOB_INDEX', 'Index');

define('_MI_MYJOB_MENU1', 'Voir les offres');
define('_MI_MYJOB_MENU2', 'Voir les demandes');
define('_MI_MYJOB_MENU3', 'Soumettre une offre');
define('_MI_MYJOB_MENU4', 'Soumettre une demande ');
define('_MI_MYJOB_MENU5', 'Mes demandes');
define('_MI_MYJOB_MENU6', 'Mes offres');
define('_MI_MYJOB_MENU7', 'Caddy');
define('_MI_MYJOB_MENU8', 'Voir les demandes sur une carte');

define('_MI_MYJOB_OPT0', "Activer les offres d'emploi ?");
define('_MI_MYJOB_OPT0_DSC', "Si vous activez cette option, les utilisateurs ont alors la possibilité de saisir et consulter des offres d'emploi");
define('_MI_MYJOB_OPT0B', "Activer les demandes d'emploi ?");
define('_MI_MYJOB_OPT0B_DSC', "Si vous activez cette option, les utilisateurs ont alors la possibilité de saisir et consulter des demandes d'emploi");

define('_MI_MYJOB_OPT1', 'Durée par défaut de publication des demandes et offres');
define('_MI_MYJOB_OPT1_DSC', "Choisissez la durée par défaut (en jours) de publication des offres et demandes d'emploi");
define('_MI_MYJOB_OPT2', "Approbation automatique des offres d'emploi");
define('_MI_MYJOB_OPT2_DSC', "Choisissez si les offres d'emploi doivent être approuvées automatiquent ou pas");
define('_MI_MYJOB_OPT3', "Approbation automatique des demandes d'emploi");
define('_MI_MYJOB_OPT3_DSC', "Choisissez si les demandes d'emploi doivent être approuvées automatiquent ou pas");

define('_MI_MYJOB_OPT4', "Nombre d'offres d'emploi par page");
define('_MI_MYJOB_OPT4_DSC', "Choisissez le nombre d'offres d'emploi visibles par page côté utilisateur (cette limite servira aussi aux flux RSS et Atom)");

define('_MI_MYJOB_OPT5', "Nombre de demandes d'emploi par page");
define('_MI_MYJOB_OPT5_DSC', "Choisissez le nombre de demandes d'emploi visibles par page côté utilisateur (cette limite servira aussi aux flux RSS et Atom)");

define('_MI_MYJOB_OPT6', "Texte à afficher durant la soumission d'une offre ou d'une demande d'emploi");
define('_MI_MYJOB_OPT6_DSC', 'Ce texte affiche des mentions légales relatives à la CNIL par exemple.');
define('_MI_MYJOB_OPT6_DEFVAL',
       "Conformément à la loi Informatique et Libertés en date du 6 janvier 1978, vous disposez par ailleurs d'un droit d'accés, de rectification, de modification et de suppression concernant les données qui vous concernent. Vous pouvez exercer ce droit en envoyant un courriel au responsable de ce site.");

define('_MI_MYJOB_OPT7', 'Utiliser les flux RSS et Atom ?');
define('_MI_MYJOB_OPT7_DSC', "Si vous utilisez cette option, les derniéres offres et demandes d'emploi seront accessibles via un flux RSS et Atom. Les flux RSS et Atom des offres d'emploi ne seront disponibles que si vous avez choisit d'utiliser les offres d'emploi, idem pour les demandes.");

define('_MI_MYJOB_OPT8', "Permettre le téléchargement de fichiers avec les offres d'emploi ?");
define('_MI_MYJOB_OPT8_DSC', "Permet aux personnes qui proposent des offres d'emploi de joindre des documents.");

define('_MI_MYJOB_OPT9', "Permettre le téléchargement de fichiers avec les demandes d'emploi ?");
define('_MI_MYJOB_OPT9_DSC', "Permet aux personnes qui soumettent des demandes d'emploi de joindre des documents.");

define('_MI_MYJOB_OPT10', 'Taille maximale des fichiers joints en Ko (1048576 = 1 Méga)');
define('_MI_MYJOB_OPT10_DSC', '');

define('_MI_MYJOB_OPT11', "Texte à afficher durant la soumission d'une offre d'emploi");
define('_MI_MYJOB_OPT11_DSC', "Ce texte permet par exemple d'afficher une note explicative.");
define('_MI_MYJOB_OPT11_DEFVAL', "Votre adresse email est nécessaire car elle est utilisée pour vous envoyer un email qui vous permettra de gérer cette offre (modification, suppression prolongation). Cette adresse email n'est jamais dévoilée.");

define('_MI_MYJOB_OPT12', "Texte à afficher durant la soumission d'une demande d'emploi");
define('_MI_MYJOB_OPT12_DSC', "Ce texte permet par exemple d'afficher une note explicative.");
define('_MI_MYJOB_OPT12_DEFVAL',
       "Votre adresse email est nécessaire pour plusieurs raisons. Tout d'abord parce que nous nous en servons pour vous envoyer un email qui vous permettra de gérer cette demande (modification, suppression prolongation) et ensuite parce qu'elle servira aux entreprises qui sont intéressées par votre profil pour prendre contact avec vous. Cette adresse email n'est jamais dévoilée.<br>De plus, vos données personnelles ne sont pas visibles publiquement.");

define('_MI_MYJOB_OPT13', 'Autoriser les prolongations ?');
define('_MI_MYJOB_OPT13_DSC', "Permet aux personnes qui soumettent des offres d'emploi et des demandes d'emploi de demander une prolongation de publication.");

define('_MI_MYJOB_OPT14', 'Adresse email devant recevoir une copie des demandes de contact');
define('_MI_MYJOB_OPT14_DSC', "Si vous renseignez cette zone par une adresse email valide alors les demandes de contact (pour les demandes d'emploi) seront aussi envoyées à cette adresse.");

define('_MI_MYJOB_OPT15', 'Permettre aux anonymes de faire des demandes de contact ?');
define('_MI_MYJOB_OPT15_DSC', "Par défaut seuls les groupes disposant des droits de voir l'intégralité du contenu des offres peuvent faire des demandes de contacts, sauf si vous activez cette option.");

define('_MI_MYJOB_OPT16', "Taille des bulles d'aide en dhtml");
define('_MI_MYJOB_OPT16_DSC', "Les liens et certaines parties du texte contiendront une bulle d'aide dhtml (mettre � 0 pour ne pas avoir de bulle)");

define('_MI_MYJOB_OPT17', "Permettre l'export des demandes au format vCard ?");
define('_MI_MYJOB_OPT17_DSC', "Si vous activez cette option, les personnes qui disposent du droit de voir toutes les informations de la demande d'emploi pourront aussi exporter la demande au format vCard");

define('_MI_MYJOB_OPT18', "Permettre l'export des offres au format vCard ?");
define('_MI_MYJOB_OPT18_DSC', "Si vous activez cette option, il sera alors possible aux visiteurs d'exporter une offre d'emploi au format vCard");

define('_MI_MYJOB_OPT19', 'Durées de recherche');
define('_MI_MYJOB_OPT19_DSC', 'Saisissez les périodes de recherche (en jours) séparées par des virgules');

define('_MI_MYJOB_OPT20',"Afficher un lien vers l'offre ou la demande précédente et suivante ?");
define('_MI_MYJOB_OPT20_DSC',"En réglant cette option à Oui, un lien vers l'offre ou la demande précédente et suivante seront visibles");

define('_MI_MYJOB_OPT21', 'Afficher une table listant les x dernières demandes et offres ?');
define('_MI_MYJOB_OPT21_DSC',"Entrez le nombre d'offres et de demandes à afficher (0=pas de table)");

define('_MI_MYJOB_OPT22', 'Autoriser la visualisation en PDF ?');
define('_MI_MYJOB_OPT22_DSC', 'Choisissez si les demandes et les offres sont visibles en PDF');

define('_MI_MYJOB_OPT23', '[METAGEN] - Nombre maximal de meta mots clés à générer');
define('_MI_MYJOB_OPT23_DSC', 'Choisissez le nombre maximum de mots clés qui seront générés par le module à partir du contenu.');

define('_MI_MYJOB_OPT24', '[METAGEN] - Ordre des mots clés');
define('_MI_MYJOB_OPT24_DSC',"Choisissez l'ordre d'apparition des mots clés");
define('_MI_MYJOB_OPT241', "Ordre d'apparition dans le texte");
define('_MI_MYJOB_OPT242', 'Ordre de fréquence des mots');
define('_MI_MYJOB_OPT243', 'Ordre inverse de la fréquence des mots');

define('_MI_MYJOB_OPT25', '[METAGEN] - Blacklist');
define('_MI_MYJOB_OPT25_DSC', 'Entrez des mots (séparés par une virgule) qui ne doivent pas faire partie des mots clés générés.');

define('_MI_MYJOB_OPT26', 'Informations connexes');
define('_MI_MYJOB_OPT26_DSC',"Choisissez si une liste déroulante permettant d'avoir des informations connexes doit être affichée avec chaque offre et chaque demande");

define('_MI_MYJOB_OPT27', 'Types mime pour les images');
define('_MI_MYJOB_OPT27_DSC', '');

define('_MI_MYJOB_OPT28', 'Autoriser la syndication des recherches ?');
define('_MI_MYJOB_OPT28_DSC', '');

define('_MI_MYJOB_OPT29', 'Utiliser le caddy ?');
define('_MI_MYJOB_OPT29_DSC',"Est-ce que les recruteurs et les personnes à la recheche d'un emploi peuvent utiliser un caddy ?");

define('_MI_MYJOB_OPT30', "Voir les offres d'emploi sur une carte ?");
define('_MI_MYJOB_OPT30_DSC', 'Via Google Maps');

define('_MI_MYJOB_OPT31', "Voir les demandes d'emploi sur une carte ?");
define('_MI_MYJOB_OPT31_DSC', 'Via Google Maps');

define('_MI_MYJOB_OPT32',"Clé d'API Google Maps ");
define('_MI_MYJOB_OPT32_DSC', '');

define('_MI_MYJOB_GLOBAL_NOTIFY', 'Globale');
define('_MI_MYJOB_GLOBAL_NOTIFYDSC', 'Options de notification globale des offres et demandes.');
define('_MI_MYJOB_NOTIFY1', "Offres d'emploi");
define('_MI_MYJOB_NOTIFY1_DSC', "Offres d'emploi");

define('_MI_MYJOB_NOTIFY2', "Demandes d'emploi");
define('_MI_MYJOB_NOTIFY2_DSC', "Demandes d'emploi");

define('_MI_MYJOB_NOTIFY3', 'Offre soumise');
define('_MI_MYJOB_NOTIFY3_DSC', 'Offre soumise');
define('_MI_MYJOB_NOTIFY3_CAP', 'Offre soumise');

define('_MI_MYJOB_NOTIFY4', 'Offre publiée');
define('_MI_MYJOB_NOTIFY4_DSC', 'Offre publiée');
define('_MI_MYJOB_NOTIFY4_CAP', 'Offre publiée');

define('_MI_MYJOB_NOTIFY5', 'Demande soumise');
define('_MI_MYJOB_NOTIFY5_DSC', 'Demande soumise');
define('_MI_MYJOB_NOTIFY5_CAP', 'Demande soumise');

define('_MI_MYJOB_NOTIFY6', 'Demande publiée');
define('_MI_MYJOB_NOTIFY6_DSC', 'Demande publiée');
define('_MI_MYJOB_NOTIFY6_CAP', 'Demande publiée');

define('_MI_MYJOB_NOTIFY_MAIL1', "Une nouvelle offre d'emploi vient d'être soumise");
define('_MI_MYJOB_NOTIFY_MAIL2', "Une nouvelle offre d'emploi vient d'être publiée");
define('_MI_MYJOB_NOTIFY_MAIL3', "Une nouvelle demande d'emploi vient d'être soumise");
define('_MI_MYJOB_NOTIFY_MAIL4', "Une nouvelle demande d'emploi vient d'être soumise");
define('_MI_MYJOB_BNAME1', "Demandes d'emploi recentes");
define('_MI_MYJOB_BNAME2', "Demandes d'emploi les plus vues");
define('_MI_MYJOB_BNAME3', "Demandes d'emploi au hasard");
define('_MI_MYJOB_BNAME4', "Offres d'emploi recentes");
define('_MI_MYJOB_BNAME5', "Offres d'emploi les plus vues");
define('_MI_MYJOB_BNAME6', "Offres d'emploi au hasard");
define('_MI_MYJOB_BNAME7', 'Statistiques');
define('_MI_MYJOB_BNAME8',"Top ... les plus demandés dans les demandes d'emploi");
define('_MI_MYJOB_BNAME9',"Top ... les plus demandés dans les offres d'emploi");

define('_MI_MYJOB_OPT33',"Nombre d'éléments visibles dans l'administration ?");
define('_MI_MYJOB_OPT33_DSC',"Choisissez le nombre d'éléments visibles dans les listes et dans les tables");

