# Crossfilter Test
In order to evaluate the applicability of lineage in optimizing interactive visualizations.

## Schemas
### pgbench_accounts
pgbench=# \d+ pgbench_accounts;
                       Table "public.pgbench_accounts"
  Column  |     Type      | Modifiers | Storage  | Stats target | Description 
----------+---------------+-----------+----------+--------------+-------------
 aid      | integer       | not null  | plain    |              | 
 bid      | integer       |           | plain    |              | 
 abalance | integer       |           | plain    |              | 
 filler   | character(84) |           | extended |              | 
 tid      | integer       |           | plain    |              | 
Indexes:
    "pgbench_accounts_pkey" PRIMARY KEY, btree (aid)
Options: fillfactor=100
### pgbench_tellers
pgbench=# \d+ pgbench_tellers
                        Table "public.pgbench_tellers"
  Column  |     Type      | Modifiers | Storage  | Stats target | Description 
----------+---------------+-----------+----------+--------------+-------------
 tid      | integer       | not null  | plain    |              | 
 bid      | integer       |           | plain    |              | 
 tbalance | integer       |           | plain    |              | 
 filler   | character(84) |           | extended |              | 
 ccolor   | color         |           | plain    |              | 
Indexes:
    "pgbench_tellers_pkey" PRIMARY KEY, btree (tid)
Options: fillfactor=100

## Visualizations
1. Aggregated account balances vs teller's clothing color.
2. Average account-holder satisfaction by bank.
