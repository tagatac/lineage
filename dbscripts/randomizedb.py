#!/usr/bin/env python3
import psycopg2, random

DBNAME = 'pgbench'
DBUSER = 'tag'
NUM_ACCOUNTS = 1000000

conn = psycopg2.connect('dbname={} user={}'.format(DBNAME, DBUSER))
cur = conn.cursor()
for account in range(NUM_ACCOUNTS):
	balance = random.randrange(1000)
	cur.execute("UPDATE pgbench_accounts SET abalance = {} WHERE aid = {};".format(balance, account+1))
conn.commit()
cur.close()
conn.close()
