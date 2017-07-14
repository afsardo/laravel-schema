# Laravel Schema

A new seamless way to use your migrations, in a single file style, represent exacly your schema.

## Example:

#### FROM

- 2014_10_12_000000_create_users_table.php
- 2014_10_12_100000_create_password_resets_table.php

#### TO

- 0000_users.schema.php
- 0001_password_resets.schema.php

## TODO:

There is alot to do for this package to be officially launched.

- Support indexes
- Editing columns
- Make migration command overwrite
- Database cleanup command (NEW COMMAND)
- Needs to support MySQL  
- Needs to support PostgreSQL
- Needs to support SQLserver
- Add tests
