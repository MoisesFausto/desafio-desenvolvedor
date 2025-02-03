
# Desafio Desenvolvedor

Aplicação backend feita com objetivo de avaliar a lógica e capacidade de implementar uma regra de negócio solicitada.

## Stack utilizada
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=plastic&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=plastic&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=plastic&logo=mysql&logoColor=white)
![Sail](https://img.shields.io/badge/sail-%230db7ed.svg?style=plastic&logo=docker&logoColor=white)

### Sobre o Sail

Usarei para criar o ambiente Laravel com MySQL o [Sail](https://laravel.com/docs/11.x/installation#docker-installation-using-sail) que por "de baixo dos panos" usa Docker para criar
o container com as imagens que vem por padrão no Laravel. Os comando são os mesmo, alterando apenas o:

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
  docker compose up -d
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

## Verificar andamento das Filas

```bash
  sail artisan queue:work
```

## Melhorias

* Criar autentificação para consumo das apis
* Fazer uma cobertura de teste maior
* Criar um endpoint para mostrar ao usuário o progresso do carregamento
* Enviar notificação para o usuário ao finalizar o processo
* Dependendo da regra de negocio, talvez seja melhor manter os arquivos salvos em algum storage para analises
* Aplicar padrão Factory para a classe do Excel, para poder comportar outros tipos de arquivo, se no futuro for necessário

### Cache
Optei por utilzar cacheamento por file, que a princípio funciona para esse caso de uso.
Mas a melhor opção seria utilizar um Redis ou similar para ser mais perfomático a nível de
aplicação.

Também é possivel utilizar cacheamento por database, mas seria trocar 6 por meia duzia,
pois será necessário fazer requisição ao banco de dados de qualquer forma, desempenhando
um novo processo de consulta ao banco.
