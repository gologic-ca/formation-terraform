# Déploiement d'un serveur mysql avec mot de passe root inséré dans la voûte

À la première application, le code échoue parce que terraform tente d'accéder à la voûte avant qu'elle n'ait été instanciée :
```
terraform apply
Error: failed to lookup token, err=Get "http://127.0.0.1:8200/v1/auth/token/lookup-self": read tcp 127.0.0.1:50728->127.0.0.1:8200: read: connection reset by peer
```

Si on exécute le apply à nouveau, le déploiement s'exécute avec succès :
```
terraform apply
Apply complete! Resources: 2 added, 0 changed, 0 destroyed.
```

Pour assurer un déploiement convenable dès la première exécution, il faut indiquer à terraform que le serveur mysql dépend du mot de passe.

Dans le fichier mysql.tf, dans la resource "docker_container" "mysql", ajouter la ligne:
```
depends_on = [vault_generic_secret.mysql_pass]
```

Détruisez toutes les ressources et reprenez le déploiement:
```
terraform destroy
terraform apply
```
