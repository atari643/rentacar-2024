# Rent-a-car 2024

## Mise en place

1. Clonez ce dépôt
2. Installez les dépendances: `symfony composer install`
3. Éditez `.env.local` afin d'y placer votre [chaîne de connexion](https://gregwar.com/bdd.u-bordeaux.fr/)
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

Les consignes seront disponibles le 15 mars à 14h.