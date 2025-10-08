resource "local_file" "readme" {
  filename = "${path.root}/${var.exercice}.md"
  content = templatefile("${path.module}/${var.exercice}.md.tftpl", {
  })
}
