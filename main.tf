terraform {
  required_providers {
    local = {
      source  = "hashicorp/local"
      version = "~> 2.0"
    }
  }
}

provider "local" {}

module "exos" {
  source = "./modules/exos"
  exercice = "exo2"
}

resource "local_file" "example" {
  filename = "${path.module}/message.txt" # Linux
  # filename = "${path.module}\\message.txt" # Windows
  content  = "Bonjour, ce fichier est généré par Terraform !"
}

