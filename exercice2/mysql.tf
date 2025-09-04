resource "docker_image" "mysql" {
  name = "mysql:latest"
}

resource "docker_container" "mysql" {
  name  = "mysql_container"
  image = docker_image.mysql.image_id

  ports {
    internal = 3306
    external = 3306
  }

  env = [
    "MYSQL_ROOT_PASSWORD=my_insecure_password",
    "MYSQL_DATABASE=my_database",
    "MYSQL_USER=my_user",
    "MYSQL_PASSWORD=my_user_password"
  ]

  must_run = true
  restart  = "always"
}
