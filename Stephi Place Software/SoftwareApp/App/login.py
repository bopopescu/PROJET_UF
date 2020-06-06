from App.connect import connection
try:

    with connection.cursor() as cursor:

        # SQL
        sql = "SELECT prenom FROM client "

        # Exécutez la requête (Execute Query).
        cursor.execute(sql)

        print("cursor.description: ", cursor.description)

        print()

        for row in cursor:
            print(row)

finally:
    # Closez la connexion (Close connection).
    connection.close()



