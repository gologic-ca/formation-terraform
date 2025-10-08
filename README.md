# Atelier Terraform

Cet atelier va vous apprendre les bases de Terraform.
Toutes les instruction apparaitront dans ce document au fur et a mesure des exercices.

Pour cloner le dépôt, utiliser une des commandes suivantes: `git clone https://github.com/gologic-ca/formation-terraform.git`

Ou si vous avez déjà un compte Github et une clef SSH: `git clone git@github.com:gologic-ca/formation-terraform.git`

Pour vérifier que terraform est bien disponible sur votre poste et voir sa version, utiliser la commande suivante:
```bash
terraform version
```

Vous verrez plusieurs fichiers:
- main.tf contient le code principal du projet
- variables.tf contient les différentes variables du projet
- versions.tf contient le contrôle des versions

## Exercice 1
Dans ce premier exercice, nous allons créer un fichier local à l'aide de Terraform. Examinez le code puis exécutez le à l'aide des commandes suivantes:
```bash
terraform init # Initialise l'environnement terraform
terraform plan # Test le code et affiche les ressources qui vont être créés, modifiées ou supprimées
terraform apply # Applique les changements affichées par la commande précédente
```

Notez que les deux commandes plan et apply demande une variable requise - soit votre nom comme auteur.
Vous devrez trouver votre fichier de bonjour ainsi qu'un fichier MD (markdown) pour passer à l'exercice 2!