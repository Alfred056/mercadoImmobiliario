## API BCRP DATA

docker build -t srv-mercado-inmobiliario:latest .


## Deploy

docker run -p 8082:8080 --restart always -d eerazozamudio/srv-mercado-inmobiliario:1.0

