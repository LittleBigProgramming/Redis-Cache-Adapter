# Redis-Cache-Adapter

By creating a Cache Interface another cache client except redis can easily be swapped out in the future.

To create a users table that replicates what is in the `redis-cache` database enter 

```
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL DEFAULT '',
  `last_name` varchar(45) NOT NULL DEFAULT '',
  `email` varchar(320) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8mb4;
```

When the table has been created I added 1000 users to the table with the following information using [this](https://mockaroo.com/) data generator.
