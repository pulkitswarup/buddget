# TODO
- Handle sharing with people with no account
- Handle maximum people that can be added to shared list
- Convert delete to soft delete 

RUN apt-get update && apt-get install -y libmcrypt-dev \
    mysql-client libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install mcrypt pdo_mysql
    
# Commands
curl -XPUT -uelastic:changeme 'http://localhost:9200/fet?pretty&update_all_types' -d @database/migrations/2017_03_30_000000_create_fet_index.json

curl -XDELETE -uelastic:changeme http://localhost:9200/fet?pretty

curl -XGET -uelastic:changeme 'http://localhost:9200/fet/_mapping/users?pretty'

Ref:
https://nodejs-login.herokuapp.com/


Recurring:
Grocery: €270
Transport: €160
Rent: €1265 (Rent + Electricity + Water + Internet)
Mobile: €40
Medical: €209
Liability Insurance: €7
Total: €1951

On-Time:
Cycle : €90
Eating Out/Pizza/Party: €50
Total: €140

API End Points:

    # engine:
    #     image: docker.elastic.co/elasticsearch/elasticsearch:5.3.0
    #     environment:
    #         - cluster.name=docker-cluster
    #         - bootstrap.memory_lock=true
    #         - "ES_JAVA_OPTS=-Xms512m -Xmx512m"
    #         - xpack.security.enabled=false
    #         - network.bind_host=0.0.0.0
    #         - network.host=0.0.0.0
    #     ulimits:
    #         memlock:
    #             soft: -1
    #             hard: -1
    #         nofile:
    #             soft: 65536
    #             hard: 65536
    #     mem_limit: 1g
    #     cap_add:
    #         - IPC_LOCK
    #     volumes:
    #         - ./data/elasticsearch/data:/usr/share/elasticsearch/data
    #     ports:
    #         - 9200:9200


