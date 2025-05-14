# Code Citations

## License: unknown
https://github.com/eng-ahmednasser/base-project/tree/3bbc313b32ca6a19356c8a8259ce8447492e86f9/database/migrations/2020_07_11_162606_create_tickets_table.php

```
)->references('id')->on('users')->onDelete('cascade');
        $table->foreign('assigned_to')->references('id')->on('users')->onDelete
```


## License: unknown
https://github.com/LibreHealthIO/lh-ehr-laravel/tree/479e48f1ae83c56a47590867ac2f595342f44d13/database/migrations/2017_06_28_181202_create_patient_notes_table.php

```
;

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('assigned_to')->references('id')-
```

