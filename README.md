# ECF-Hypnos
## Démarche lors du premier lancement de l'application. (local)
1. Télécharger et enregirstrer le fichier sur votre ordinateur.
2. Lancer un IDE et ouvrez le dossier ECF Hypnos.
3. Ouvrez un terminal, allez a l'emplacement du dossier et lancer la commande : `symfony serve`.
4. ouvrez un nouveau terminal et lancer la commade `npm run watch`.
5. ouvrez le fichier src/Controller/RegistrationControler.php et décommenter la ligne 33 (supprimer "//" devant 'ROLE_ADMIN'), enregistrer le fichier.
6. aller à l'adresse "https://127.0.0.1:8000/login" et cliquer sur s'enregistrer et rentrez vos informations.
7. Une fois l'enregistrement effectué, retourner dans le fichier src/Controller/RegistrationControler.php et recommenter la ligne 33 (ajouter "//" devant 'ROLE_ADMIN').
8. Voila le site est fonctionnel.
