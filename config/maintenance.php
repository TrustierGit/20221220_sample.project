<?php
return[

    'open_from' => env('OPEN_FROM'),
    'open_to'=>env('OPEN_TO'),
    'user_eol' => env('USER_EOL'),
    'user_mode' => [
        0 =>'user_authority',
        1 =>'admin_authority',
        9 =>'super_authority',
    ],
    'info_page_count' => env('INFO_PAGE_COUNT'),
    'period' =>env('PERIOD'),

];