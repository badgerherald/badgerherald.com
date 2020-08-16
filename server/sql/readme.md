### .sql imports for local development

Place `.sql` files here for the local dev mariadb database to import on initial install.

Then configure the sql database info in your `.env`.

### Production databases

When running in production, always update the sql host as well, as **production should never run against the local sql database**. The development mariadb container runs on fragile-state docker volumes with no backups and is not tuned for production performance.

The best practice is to use an independent mysql database or service (aws, azure, etc), though you may also run a sql service on the host machine.


