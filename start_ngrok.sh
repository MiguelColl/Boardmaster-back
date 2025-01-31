#!/bin/bash

getNgrokUrl() {
	echo $(curl -s http://localhost:4040/api/tunnels | jq ".tunnels[0].public_url" | sed 's/"//g')
}

showUrlData() {
	echo "Para monitorear las peticiones accede a: http://localhost:4040/inspect/http"
	echo "La url del servidor es: $url"
}

url=$(getNgrokUrl)

if [[ ! -z $url ]]
then
	echo -e "El servidor ngrok ya esta en marcha\n"
	showUrlData

	exit 1
fi

nohup ngrok http http://localhost:8000 > /dev/null 2>&1 &
echo -n "Ejecutando el servidor ngrok en segundo plano..."

while [[ -z $url || $url == "null" ]]
do
	sleep 1
	echo -n '.'
	url=$(getNgrokUrl)
done

echo -e "\nServidor ngrok en funcionamiento\n"

# pid=$!
# jobID=$(jobs -l | grep "$pid" | sed -n 's/^\[\([0-9]\+\)\].*/\1/p')
# echo "Ejecuta el siguiente comando para recuperar la pantalla de datos de ngrok: fg %$jobID"

sed -i "s|NGROK_URL=\".*\"|NGROK_URL=\"$url\"|" .env

showUrlData

exit 0
