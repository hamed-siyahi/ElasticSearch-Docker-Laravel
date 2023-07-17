--chmod-- approch RUN chmod +x ./src/server.ts


RUN echo "HHHHHHHHHHHHHHHH"
      bash -c '
       	  curl  -XPUT "http://65.109.187.4:9200/users/_doc/1?pretty" -H "Content-Type: application/json" -d'
{
      "content": "My first tweet",
      "user_name": "carloslannister",
      "tweeted_at": "2015-02-20",
      "likes": 2
}
'
