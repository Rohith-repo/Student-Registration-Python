import mysql.connector
import pandas as pd
db_user = 'root'
db_password = ''
db_name = 'test'
db_host = 'localhost'
db_port = 3306
try:
    mydb = mysql.connector.connect(
        user=db_user,
        password=db_password,
        host=db_host,
        database=db_name,
        port=db_port
    )
    if mydb.is_connected():
        print("Connection established")
    cursor = mydb.cursor()
    query = "SELECT * FROM registration"
    cursor.execute(query)
    student_data = cursor.fetchall()
    column_names = [i[0] for i in cursor.description]
    student_df = pd.DataFrame(student_data, columns=column_names)
    print(student_df)
except mysql.connector.Error as err:
    print(f"Error: {err}")
finally:
    if 'cursor' in locals():
        cursor.close()
    if 'mydb' in locals() and mydb.is_connected():
        mydb.close()
        print("Connection closed")
