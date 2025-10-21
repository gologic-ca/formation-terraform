# Atelier Terraform

Cet atelier vous permettra d'apprendre les bases de Terraform à travers différents exercices.

## Prérequis

- Docker Engine ou Desktop (WSL2)
- Terraform installé sur votre poste
- Git installé
- Un éditeur de texte

## Installation

Pour cloner le dépôt, utilisez une des commandes suivantes :

**HTTPS :**
```bash
git clone https://github.com/gologic-ca/formation-terraform.git
```

**SSH (si vous avez déjà un compte GitHub et une clé SSH) :**
```bash
git clone git@github.com:gologic-ca/formation-terraform.git
```

## Vérification de l'installation

Pour vérifier que Terraform est bien disponible sur votre poste et voir sa version, utilisez la commande suivante :
```bash
terraform version
```

Vous devriez voir une sortie similaire à :
```
Terraform v1.x.x
```

## Structure du projet

Vous verrez plusieurs fichiers :
- `main.tf` : contient le code principal du projet
- `variables.tf` : contient les différentes variables du projet
- `versions.tf` : contient le contrôle des versions des providers

Aussi:
- `modules` : contient le code pour générer les prochais exercices en Markdown (.md).
- `webapp-content`: contient du code pour un application web déployée pendant l'exercice


## Exercice 1 : Création d'un fichier local

Dans ce premier exercice, nous allons créer un fichier local à l'aide de Terraform.

### Objectifs de cet exercice

Dans cet exercice, nous allons apprendre à :
- Apprendre les commandes Terraform de bases
- Utilisation de variable
- L'appel d'un module enfant
- Utiliser le provider 'local' pour créer un fichier local

### Étapes à suivre

1. Examinez le code dans les fichiers `.tf`
2. Exécutez les commandes suivantes dans l'ordre :

```bash
# Initialise l'environnement Terraform et télécharge les providers nécessaires
terraform init

# Teste le code et affiche les ressources qui vont être créées, modifiées ou supprimées
terraform plan

# Applique les changements affichés par la commande précédente
terraform apply
```

### Variables requises

Les commandes `plan` et `apply` demandent une variable requise : **votre nom comme auteur**.

Vous pouvez fournir cette variable de plusieurs façons :
- Interactivement quand Terraform vous le demande
- En ligne de commande : `terraform apply -var="author=VotreNom"`
- Dans un fichier `terraform.tfvars`

### Objectif

À la fin de cet exercice, vous devrez trouver :
- Un fichier de bonjour créé localement
- Un fichier Markdown (MD) généré pour l'exercice 2

Notez que les liens Markdown (comme le suivant), n'est que fonctionnel en local (par votre éditeur de texte) !

Une fois ces fichiers créés, vous pourrez passer à [l'exercice 2](./exercice2.md) !