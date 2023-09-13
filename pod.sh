POD_NAME=laravel-forum
CMD=$1

if [ -z $CMD ]; then
    echo "Command must be start or stop"
    exit 1;
elif [ $CMD = "start" ]; then
    echo "Starting pod $POD_NAME..."
    podman pod start $POD_NAME
elif [ $CMD = "stop" ]; then
    echo "Stoping pod $POD_NAME..."
    podman pod start $POD_NAME
else
    echo "Unknown command: $CMD"
    exit 1;
fi
