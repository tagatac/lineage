#!/usr/bin/env python3
import psycopg2, random

DBNAME = 'pgbench'
DBUSER = 'tag'
MAX_BALANCE = 1000
MAX_SATISFACTION = 10
NUM_ACCOUNTS = 1000000
NUM_TELLERS = 100

conn = psycopg2.connect('dbname={} user={}'.format(DBNAME, DBUSER))
cur = conn.cursor()
for account in range(NUM_ACCOUNTS):
	balance = random.randrange(MAX_BALANCE+1)
	teller = random.randrange(NUM_TELLERS)
	satisfaction = random.randrange(MAX_SATISFACTION)
	cur.execute('UPDATE pgbench_accounts SET abalance = {}, tid = {}, satisfaction = {} WHERE aid = {};'.format(balance, teller+1, satisfaction+1, account+1))
conn.commit()
for teller in range(NUM_TELLERS):
	clothing_color = ('red', 'orange', 'yellow', 'green', 'blue', 'purple', 'white', 'black')[random.randrange(8)]
	cur.execute("UPDATE pgbench_tellers SET ccolor = color('{}') WHERE tid = {};".format(clothing_color, teller+1))
conn.commit()
cur.close()
conn.close()
