
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
  cd desafio-desenvolvedor
```

Instale as dependências

```bash
  npm 
```

Inicie o servidor

```bash
  npm run start
```


## Rodando os testes

Para rodar os testes, rode o seguinte comando

```bash
  npm run test
```


## Documentação da API

#### Upload do arquivo que precisa ser no seguinte formato: csv, xls ou xlsx

```http
  POST /api/upload
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `file` | `file` | **Obrigatório**. csv, xls, xlsx |

#### Retorna um item

```http
  GET /api/items/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `string` | **Obrigatório**. O ID do item que você quer |

Recebe dois números e retorna a sua soma.


## Melhorias

Que melhorias você fez no seu código? Ex: refatorações, melhorias de performance, acessibilidade, etc

