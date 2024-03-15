# Rent-a-car

## Mise en place

1. Clonez ce dépôt
2. Installez les dépendances: `symfony composer install`
3. Éditez `.env.local` et `.env.test` afin d'y placer votre [chaîne de connexion](https://gregwar.com/bdd.u-bordeaux.fr/)
4. Mettez à jour la base de données de production et de test:
```
symfony console doctrine:schema:drop --force
symfony console doctrine:schema:create
symfony console --env=test doctrine:schema:drop --force
symfony console --env=test doctrine:schema:create
```
5. Chargez les *fixtures*:
```
symfony console doctrine:fixtures:load -n
symfony console --env=test doctrine:fixtures:load -n
```
6. Vous pouvez vous assurer que les tests s’exécutent:
```
php bin/phpunit
```
7. Lancez `symfony serve`

## Réalisation

**IMPORTANT: À lire avant de commencer**

* Ce fichier doit être placé à la racine de votre dépôt, sous le nom `README.md`.
* Vous indiquerez les questions traitées, en remplaçant `[ ]` par `[x]`.
* Vous **commiterez** et **pousserez** le fichier *README.md*.
* Le code initial est équipé de tests unitaires, la base est déjà réinitialisée automatiquement entre chaque test.

### Requêtes avec Postman

Lancez *Postman* (au département vous pourrez exécuter: `/mnt/raddix/opt/postman/Postman)`.
Pour chaque question ci-dessous, faites fonctionner la requête avec *Postman*, puis générez
le code correspondant à l'aide du panneau *"Code snippet"* à droite, en sélectionnant
*"Python - Requests"*.

- [X] Obtenir la liste de toutes les voitures.
   Vous placerez le résultat dans `postman/p1_obtenir_voitures.py`
- [ ] Marquer la voiture `2` comme louée.
   Vous placerez le résultat dans `postman/p2_marquer_voiture_louee.py`
- [X] Créer une nouvelle voiture de nom `Dacia Sandero` et d'immatriculation `ABX1722E` dans l'agence `2`.
   Vous placerez le résultat dans `postman/p3_creer_voiture.py`

### Ajout l'adresses des agences

- Remarquez que l'adresse des agences ne s'affiche pas dans `/api/agencies`.
  - [X] Modifiez le code afin qu'elle apparaisse
  - [ ] Modifiez les tests afin qu'ils testent que les adresses correspondent bien au jeu de test

### Suppression des voitures

- On souhaite pouvoir supprimer une voiture
  - [X] Ajoutez un *endpoint* `DELETE /api/car/{id}` qui permet de supprimer une voiture
  - [X] Ajoutez la documentation correspondante

## Affichage des voitures dans `/api/agencies`

- On souhaite disposer d'un *endpoint* `/api/agency/{id}` en `GET` qui permette d'obtenir la liste des voitures
d'une agence.
  - [X] Créez le *endpoint* et la documentation correspondante
    (Indication: Vous pourrez vous inspirer de `/api/car/{id}`)
  - [X] Affichez les voitures associés à l'agence
    (Indication: Cela peut être fait en jouant uniquement sur les *groupes de sérialisation*)

## Filtrage des agences

- On souhaite ajouter un paramètre *optionnel* `only_available` au *endpoint* `/api/agencies`, afin de permettre de filtrer
la liste des agences et de ne voir que les agences ayant des voitures disponibles (en interrogeant
`/api/agencies?only_available=true` par exemple).
  - [X] Ajoutez le paramètre `only_available` au *endpoint* `/api/agencies`
  - [X] Ajoutez le paramètre dans la documentation
  - [X (à moitier)] Ajoutez le code dans `AgencyApiController::index` permettant de prendre en compte le paramètre
  - [ ] Ajoutez un test unitaire permettant de valider le bon fonctionnement de ce *endpoint* avec le paramètre `only_available`.

## Correction de test

- [ ] Remarquez que le test qui marque une voiture comme louée n'est pas consistant avec le code, corrigez-le.