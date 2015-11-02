#!/usr/bin/env python3
import subprocess, psycopg2, sys

DBNAME = 'pgbench'
DBUSER = 'tag'

#print('dbname={} user={}'.format(DBNAME, DBUSER))
#sys.exit()

# delete the pgbench DB if it already exists
input("About to drop the pgbench database! Press 'Ctrl-C' to cancel or 'Return' to continue.")
subprocess.call(['dropdb', 'pgbench'])
# create the test database
subprocess.call(['createdb', 'pgbench'])
# initialize the test database with some stock pgbench options
subprocess.call(['pgbench', '-i', '-s', '10', 'pgbench'])

conn = psycopg2.connect('dbname={} user={}'.format(DBNAME, DBUSER))
with conn:
	with conn.cursor() as curs:
		# add a teller id column to accounts table
		curs.execute("ALTER\040TABLE\040pgbench_accounts\040ADD\040tid\040INTEGER;")
		# add an account-holder satisfaction column to the accounts table
		curs.execute("ALTER\040TABLE\040pgbench_accounts\040ADD\040satisfaction\040INTEGER;")
		# create a color type
		curs.execute("CREATE\040TYPE\040color\040AS\040ENUM\040('red',\040'orange',\040'yellow',\040'green',\040'blue',\040'purple',\040'white',\040'black');")
		# add a clothing color column to the tellers table
		curs.execute("ALTER\040TABLE\040pgbench_tellers\040ADD\040ccolor\040color;")
conn.close()
