variable "exercice" {
  type = string
  default = "exo2"
}

resource "local_file" "readme" {
  filename = "${path.root}/README.md"
  content  = templatefile("${path.module}/exo2.md.tftpl", {
    timestamp = timestamp()
  })
}
