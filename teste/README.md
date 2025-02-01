
# Desafio Desenvolvedor

Aplicação backend feita com objetivo de avaliar a lógica e capacidade de implementar uma regra de negócio solicitada.

## Stack utilizada
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=plastic&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=plastic&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=plastic&logo=mysql&logoColor=white)
![Sail](https://img.shields.io/badge/sail-%230db7ed.svg?style=plastic&logo=docker&logoColor=white)

## Rodando localmente

Clone o projeto

```bash
  git clone https://github.com/MoisesFausto/desafio-desenvolvedor
```

Entre no diretório do projeto

```bash
  cd desafio-desenvolvedor/teste
```

Instale as dependências

```bash
  sail composer install
```

Inicie o servidor

```bash
  sail up -d
```


## Rodando os testes

Para rodar os testes, rode o seguinte comando

```bash
  sail artisan test
```

## Documentação da API

#### Upload do arquivo que precisa ser no seguinte formato: csv, xls ou xlsx

```http
  POST /api/upload
```

| Parâmetro   | Tipo       | Descrição                          | Formato |
| :---------- | :--------- | :--------------------------------- |:--------|
| `file` | `file` | **Obrigatório**. | csv, xls, xlsx

#### Busca um historico de arquivos

```http
  GET /api/file-history/{FileName}/{RptDt}
```

| Parâmetro   | Tipo       | Descrição                              | Formato |
| :---------- | :--------- |:---------------------------------------|: --------|
| `FileName`      | `string` | **Opcional**.                          |
| `RptDt`      | `string` | **Opcional**.                          | YYYY-MM-DD

#### Busca conteúdo do arquivo
_Caso não passar nenhum parametro, será trago todos os registros páginados_

```http
  POST /api/file-search
```
| Parâmetro   | Tipo       | Descrição                              | Formato |
| :---------- | :--------- |:---------------------------------------|: --------|
| `TckrSymb`      | `string` | **Opcional**.                          |
| `RptDt`      | `string` | **Opcional**.                          | YYYY-MM-DD

## Melhorias

Que melhorias você fez no seu código? Ex: refatorações, melhorias de performance, acessibilidade, etc

