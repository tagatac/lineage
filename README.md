# Implementations of Various Interaction Techniques
## Description
In order to evaluate the applicability of lineage in optimizing interactive visualizations.

## PGBench Schemas
### pgbench_accounts
```
                         Table "public.pgbench_accounts"
    Column    |     Type      | Modifiers | Storage  | Stats target | Description 
--------------+---------------+-----------+----------+--------------+-------------
 aid          | integer       | not null  | plain    |              | 
 bid          | integer       |           | plain    |              | 
 abalance     | integer       |           | plain    |              | 
 tid          | integer       |           | plain    |              | 
 satisfaction | integer       |           | plain    |              | 
Indexes:
    "pgbench_accounts_pkey" PRIMARY KEY, btree (aid)
Options: fillfactor=100
```
### pgbench_tellers
```
pgbench=# \d+ pgbench_tellers
                        Table "public.pgbench_tellers"
  Column  |     Type      | Modifiers | Storage  | Stats target | Description 
----------+---------------+-----------+----------+--------------+-------------
 tid      | integer       | not null  | plain    |              | 
 ccolor   | color         |           | plain    |              | 
Indexes:
    "pgbench_tellers_pkey" PRIMARY KEY, btree (tid)
Options: fillfactor=100
```
