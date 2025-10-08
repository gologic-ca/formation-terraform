module "exos2" {
  source   = "./modules/exercices"
  exercice = "exercice2"
}

resource "local_file" "message_bonjour" {
  filename = "${path.module}/message.txt"
  content  = "Bonjour, ce fichier est généré par Terraform ! Signé par ${var.author}"
}
