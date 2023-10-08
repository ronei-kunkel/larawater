#!/bin/bash

# vai para o diretório do projeto
cd ~/projects/larawater

# atualiza o repositório local com a última versão do projeto
git pull origin deploy

# monta a imagem com a última versão do projeto
docker build -t larawater .

# para o container que está atualmente rodando com a penúltima versão do projeto
if [[ $(docker ps -q -f name=larawater-app) ]]; then
  docker stop larawater-app
fi

# renomeia o contaner com a antepenúltima versão do projeto para ser removida
if [[ $(docker ps -q -f name=larawater-app-last) ]]; then
  docker rename larawater-app-last larawater-app-removed
fi

# renomeia o container com a penúltima versão do projeto
if [[ $(docker ps -q -f name=larawater-app) ]]; then
  docker rename larawater-app larawater-app-last
fi

# roda um novo container com a imagem contendo a última versão do projeto
if ! docker run -d -p 80:80 --name larawater-app larawater; then
  docker start larawater-app-last
fi

# remove o container com a antepenúltima versão do projeto
if [[ $(docker ps -q -f name=larawater-app-removed) ]]; then
  docker rm larawater-app-removed
fi
