function schema_donnee()
{
    return {
      "type": "array",
      "items": {
         "title" : "Votre Schema de donnee",
         "description" : "Une description test",
          "type": "object",
          "properties": {
              "name_post_type" : {
                "title": "Le nom du Post Type",
                "type": "array",
                "items" :
                {
                  "title" : "uncompletement",
                  "type" : "object",
                  "properties" : {
                        "nom" : {
                          "title" : "kebab",
                          "type" : "string",
                        },
                        "famille" : {
                          "title" : "mère",
                          "type" : "string"
                        }
                  }
                }
              },
            }
          }
    }
}
