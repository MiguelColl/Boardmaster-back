#!/bin/bash

pid=$(pgrep -f "ngrok http")

if [[ -z $pid ]]
then
	echo "El servidor ngrok no está en marcha"
else
	kill $pid
	echo "Servidor ngrok desconectado correctamente"
fi

exit 0
