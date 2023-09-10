POD_NAME=laravel-forum

PGADMIN_IMAGE=docker.io/dpage/pgadmin4
PGSQL_IMAGE=docker.io/library/postgres

PGSQL_PASSWORD=1234

PGADMIN_EMAIL=pgadmin@example.com
PGADMIN_PASSWORD=K4HeAk1xzNg4OZ9zAZVKSSwXs
PGADMIN_PORT=5050

podman pod create \
    -p 5050:5050 \
    -p 5432:5432 \
    $POD_NAME

podman create \
    --name ${POD_NAME}-db \
    -e "POSTGRES_PASSWORD=$PGSQL_PASSWORD" \
    --pod $POD_NAME \
    $PGSQL_IMAGE

podman create \
    -e "PGADMIN_DEFAULT_EMAIL=$PGADMIN_EMAIL" \
    -e "PGADMIN_DEFAULT_PASSWORD=$PGADMIN_PASSWORD" \
    -e "PGADMIN_LISTEN_PORT=$PGADMIN_PORT" \
    --name ${POD_NAME}-pgadmin \
    --pod $POD_NAME \
    $PGADMIN_IMAGE
