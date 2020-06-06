import pymysql.cursors

connection = pymysql.connect(host='localhost',
                             user='root',
                             password='root',
                             db='ynov_projet_uf',
                             cursorclass=pymysql.cursors.DictCursor)

print("connect successful!!")
