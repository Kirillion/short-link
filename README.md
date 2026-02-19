# Сервис коротких ссылок

## Запуск

Для запуска необходимо иметь на машине ```Docker-Compose```.

Введите команды поочередно, находясь в корне проекта:
```
docker-compose up -d
```

```
docker-compose exec db mariadb -u root -psecret -e "
CREATE USER 'short_link'@'%' IDENTIFIED BY 'password_short_link';
CREATE DATABASE short_link;
GRANT ALL PRIVILEGES ON short_link.* TO 'short_link'@'%';
FLUSH PRIVILEGES;
"
```

```
docker-compose exec app composer install
```

```
docker-compose exec app php yii migrate --interactive=0
```

Можно открывать <a href='http://localhost/'>localhost</a>
