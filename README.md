[![Build Status](https://travis-ci.com/rsilveira65/vuttr.svg?branch=master)](https://travis-ci.com/rsilveira65/vuttr)


#vuttr

## Usage

Create the .env file running

    $ cp .env.dist .env

Make sure that you have [docker](https://www.docker.com) and [docker-compose](https://docs.docker.com/compose/) properly installed.

    $ docker-compose up -d
    

Server will be running at http://localhost:3000

Create the database schema

    $ docker-compose exec --user=root application bin/console doctrine:schema:update --force
    
Populate the database

    $ docker-compose exec --user=root application bin/console doctrine:fixtures:load -n



## REST Routes


- Create new tool
```bash
POST: http://localhost:3000/api/tools
```
Body:
```bash
{
    "title": "hotel",
    "link": "https://github.com/typicode/hotel",
    "description": "Local app manager. Start apps within your browser, developer tool with local .localhost domain and https out of the box.",
    "tags":["node", "organizing", "webapps", "domain", "developer", "https", "proxy"]
}
```
Response
```bash
{
    "title": "hotel",
    "link": "https://github.com/typicode/hotel",
    "description": "Local app manager. Start apps within your browser, developer tool with local .localhost domain and https out of the box.",
    "tags":["node", "organizing", "webapps", "domain", "developer", "https", "proxy"],
    "id":5
}
```

- List tools
```bash
GET: http://localhost:3000/api/tools
```

Response
```bash
[
        {
            id: 1,
            title: "Notion",
            link: "https://notion.so",
            description: "All in one tool to organize teams and ideas. Write, plan, collaborate, and get organized. ",
            tags: [
                "organization",
                "planning",
                "collaboration",
                "writing",
                "calendar"
            ]
        },
        {
            id: 2,
            title: "json-server",
            link: "https://github.com/typicode/json-server",
            description: "Fake REST API based on a json schema. Useful for mocking and creating APIs for front-end devs to consume in coding challenges.",
            tags: [
                "api",
                "json",
                "schema",
                "node",
                "github",
                "rest"
            ]
        },
        {
            id: 3,
            title: "fastify",
            link: "https://www.fastify.io/",
            description: "Extremely fast and simple, low-overhead web framework for NodeJS. Supports HTTP2.",
            tags: [
                "web",
                "framework",
                "node",
                "http2",
                "https",
                "localhost"
            ]
        }
    ]
```

- Delete tool
```bash
DELETE: http://localhost:3000/api/tools/id/{TOOL_ID}
```
- Search tool by tag
```bash
GET: http://localhost:3000/api/tools/tag/node
```
Response
```bash
[
        {
            id: 2,
            title: "json-server",
            link: "https://github.com/typicode/json-server",
            description: "Fake REST API based on a json schema. Useful for mocking and creating APIs for front-end devs to consume in coding challenges.",
            tags: [
                "api",
                "json",
                "schema",
                "node",
                "github",
                "rest"
            ]
        },
        {
            id: 3,
            title: "fastify",
            link: "https://www.fastify.io/",
            description: "Extremely fast and simple, low-overhead web framework for NodeJS. Supports HTTP2.",
            tags: [
                "web",
                "framework",
                "node",
                "http2",
                "https",
                "localhost"
            ]
        }
    ]

```

## Tests

Run `docker exec --user=root application ./vendor/bin/simple-phpunit` from the root folder.
