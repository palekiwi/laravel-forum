POD_NAME=laravel-forum

APP_IMAGE=localhost/laravel/8.2-pgsql
PGADMIN_IMAGE=docker.io/dpage/pgadmin4
PGSQL_IMAGE=docker.io/library/postgres
SEARCH_IMAGE=docker.io/getmeili/meilisearch:latest

APP_DIR=/home/pl/code/php/laravel-forum
DB_DIR=/home/pl/box/laravel-forum/db
SEARCH_DIR=/home/pl/box/laravel-forum/meili_data

PGSQL_PASSWORD=1234

PGADMIN_EMAIL=pgadmin@example.com
PGADMIN_PASSWORD=K4HeAk1xzNg4OZ9zAZVKSSwXs
PGADMIN_PORT=5050

podman pod create \
    -p 8000:8000 \
    -p 5050:5050 \
    -p 5432:5432 \
    -p 5173:5173 \
    -p 7700:7700 \
    --userns=keep-id \
    $POD_NAME

# app container
podman create \
    --name ${POD_NAME}-app \
    -v $APP_DIR:/app:Z \
    --pod $POD_NAME \
    $APP_IMAGE

# db container
podman create \
    --name ${POD_NAME}-db \
    -e "POSTGRES_PASSWORD=$PGSQL_PASSWORD" \
    -v $DB_DIR:/var/lib/postgresql/data:Z \
    --pod $POD_NAME \
    $PGSQL_IMAGE

# search container
podman create \
    --name ${POD_NAME}-search \
    --pod $POD_NAME \
    -e MEILI_ENV="development" \
    -e MEILI_MASTER_KEY='rgzUyt-OYHJWzjoojcTDeLE4waAmsK67mdH6AYXS93k'\
    -v $SEARCH_DIR:/meili_data:Z \
    $SEARCH_IMAGE

# pgadmin container
podman create \
    -e "PGADMIN_DEFAULT_EMAIL=$PGADMIN_EMAIL" \
    -e "PGADMIN_DEFAULT_PASSWORD=$PGADMIN_PASSWORD" \
    -e "PGADMIN_LISTEN_PORT=$PGADMIN_PORT" \
    --name ${POD_NAME}-pgadmin \
    --pod $POD_NAME \
    $PGADMIN_IMAGE
