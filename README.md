BiruniLabs Accounting
============================

BiruniLabs Accounting is a simple General Ledger Application which currently supports double entry, single entry, and multi currency.


Developed using Yii 2 Framework and PostgreSQL database. Currently only PostgreSQL is supported since some of the reports is using *Common Table Expression* (*CTE*) which MySQL does not support.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.
