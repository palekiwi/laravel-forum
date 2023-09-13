POD_NAME=laravel-forum
CMD=$1

case $CMD in
    "start")
        echo "Starting pod $POD_NAME..."
        podman pod start $POD_NAME
        ;;
    "stop")
        echo "Stopping pod $POD_NAME..."
        podman pod stop $POD_NAME
        ;;
    *)
        echo "Invalid command. Must be start or stop."
        exit 1;
        ;;
esac
