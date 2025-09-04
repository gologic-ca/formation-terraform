terraform {
  required_providers {
    local = {
      source  = "hashicorp/local"
      version = "~> 2.0"
    }
    docker = {
      source  = "kreuzwerker/docker"
      version = "~> 2.0"
    }
  }
}

provider "local" {}

provider "docker" {
  host = "unix:///var/run/docker.sock" // Configuration pour Docker dans WSL
}

