resource "docker_image" "vault" {
  name = "hashicorp/vault:1.20"
}

resource "docker_container" "vault" {
  name  = "vault_container"
  image = docker_image.vault.image_id

  ports {
    internal = 8200
    external = 8200
  }

  env = [
    "VAULT_DEV_ROOT_TOKEN_ID=root",
    #"VAULT_LOCAL_CONFIG={\"backend\":{\"file\":{\"path\":\"/vault/file\"}},\"listener\":{\"tcp\":{\"address\":\"127.0.0.1:8201\",\"tls_disable\":1}}}"
    "VAULT_LOCAL_CONFIG={\"backend\":{\"file\":{\"path\":\"/vault/file\"}},\"tls_disable\":1}}}"
  ]

  must_run = true
  restart  = "always"
}
