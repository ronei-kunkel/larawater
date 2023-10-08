#!/bin/bash

# vai para o diretório do projeto
cd ~/projects/larawater

# atualiza o repositório local com a última versão do projeto
git pull origin deploy

# monta a imagem com a última versão do projeto
docker build -t larawater .

# para o container que está atualmente rodando com a penúltima versão do projeto
docker stop larawater-app

# renomeia o contaner com a antepenúltima versão do projeto para ser removida
docker rename larawater-app-last larawater-app-removed

# renomeia o container com a penúltima versão do projeto
docker rename larawater-app larawater-app-last

# roda um novo container com a imagem contendo a última versão do projeto
docker run -d -p 80:80 --name larawater-app larawater

# remove o container com a antepenúltima versão do projeto
docker rm larawater-app-removed

# mostra os logs do container
docker logs -f larawater-app