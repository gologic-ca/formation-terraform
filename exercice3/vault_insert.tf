locals {
  vault_address = "http://127.0.0.1:8200"
  vault_token   = "root"
  secret_path   = "secret/mysql"
  secret_data   = {
    username = "root"
    password = "my_secure_password"
  }
}

provider "vault" {
  address = local.vault_address
  token   = local.vault_token
}

resource "vault_generic_secret" "mysql_pass" {
  path = local.secret_path

  data_json = jsonencode(local.secret_data)

  depends_on = [docker_container.vault]
}
