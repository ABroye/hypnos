# hypnos
 ECF STUDI Hypnos Group
 14 mars 2022 jusqu’au 21 avril 2022

Titre professionnel de la DREETS de juin 2022

Activité – Type 1 : Développer la partie front-end d’une application web ou web mobile en intégrant les recommandations de sécurité

1. Maquetter une application
2. Réaliser une interface utilisateur web statique et adaptable
3. Développer une interface utilisateur web dynamique
4. Réaliser une interface utilisateur avec une solution de gestion de contenu ou e-commerce

Activité – Type 2 : Développer la partie back-end d’une application web ou web mobile en intégrant les recommandations de sécurité́

1. Créer une base de données
2. Développer les composants d’accès aux données
3. Développer la partie back-end d’une application web ou web mobile
4. Élaborer et mettre en oeuvre des composants dans une application de gestion de contenu ou e-commerce

CAHIER DES CHARGES ET CLAUSES PARTICULIÈRES :

Hypnos est un groupe hôtelier fondé en 2004.

Propriétaire de 7 établissements dans les quatre coins de l’hexagone, chacun de ces hôtels s’avère être une destination idéale pour les couples en quête d’un séjour romantique à deux.

Chaque suite au design luxueux inclut des services hauts de gamme (un spa privatif notamment), de quoi plonger pleinement dans une atmosphère chic-romantique.

Hypnos souhaiterait ne pas dépendre uniquement de sites tiers comme Booking.com pour la location de ses chambres.

C’est pourquoi le groupe hôtelier aimerait être pourvu de son propre système de réservation sur un nouveau site web.

Information importante : Le paiement n'est pas une fonctionnalité à envisager, car il se fait obligatoirement sur place.

Fonctionnalités désirées :

US1. Gérer les établissements

Utilisateurs concernés : Administrateurs

L’administrateur est un employé du groupe Hypnos chargé du maintien de l’application web.
Lui seul peut créer, modifier ou supprimer un établissement. Chaque établissement a un nom, une ville, une adresse et une description.
L’administrateur doit pouvoir aussi être en capacité de maintenir les utilisateurs dont le but est de remplir les informations concernant leur propre établissement : les gérants.
Chaque gérant a un nom, un prénom, une adresse e-mail et un mot de passe sécurisé.


US2. Gérer les suites

Utilisateurs concernés : Gérants

Le gérant ne voit que l’établissement dont il assume la responsabilité.
Depuis son interface utilisateur, il doit pouvoir indiquer une ou plusieurs suites.
Chaque suite possède un titre, une image mise en avant, un texte descriptif, son prix, une galerie d’images, un lien vers sa réservation booking.com.
Nota Bene : Le prix d’une suite par nuit est fixe, quelle que soit sa période de réservation.


US3. Découvrir le catalogue des établissements
Utilisateurs concernés : Visiteurs
Tout visiteur du site peut en savoir plus sur les établissements qui composent le groupe hôtelier.
Chaque établissement a sa propre page web où est présentée sous forme d’une liste chaque suite avec ses informations.


US4. Réserver une suite
Utilisateurs concernés : Visiteurs, Clients
Une page du site permettra de réserver une suite. 4 champs de formulaire seront présents :
Le choix de l’établissement, le choix de la suite, la date de début du séjour ainsi que sa date de fin. Sans rechargement de la page, on doit pouvoir savoir si la suite est disponible ou non sur les critères visés.
Si l’utilisateur veut valider sa réservation, il n’a pas d’autres choix que de se connecter ou se créer un compte. Les informations demandées : un nom, un prénom, une adresse email et un mot de passe sécurisé.


US5. Voir ses réservations
Utilisateurs concernés : Clients
Si un client se connecte grâce à ses identifiants, il peut à tout moment retrouver ses précédentes réservations sur le site web.
Il peut ainsi en annuler une au besoin. Attention, ce sera possible seulement si c’est fait au moins 3 jours avant la date inscrite !


US6. Accélérer la réservation d’une suite
Utilisateurs concernés : Visiteurs, Clients
Sur la page web d’un établissement où toutes les suites sont disponibles, un bouton “Réserver” redirigera sur la page de réservation. Cependant, certains champs de formulaire (établissement, suite) seront cette fois automatiquement pré-remplis pour la suite en question.


US7. Contacter le groupe hôtelier
Utilisateurs concernés : Visiteurs, Clients, Administrateurs
Un visiteur doit pouvoir contacter un établissement s’il désire avoir plus d’informations avant de réserver une nuit. De même pour un client, s’il veut commander un service non inclus pour le jour J.
Ce formulaire de contact accessible demandera le nom/prénom/email de la personne, un sujet ainsi que le corps du message.

4 sujets sont disponibles :
- Je souhaite poser une réclamation
- Je souhaite commander un service supplémentaire
- Je souhaite en savoir plus sur une suite
- J’ai un souci avec cette application

Pour l’instant, l’administrateur sera celui qui recevra les demandes.
