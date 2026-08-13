<?php

header("X-Frame-Options: DENY");

header(
    "Content-Security-Policy: frame-ancestors 'none'"
);

header("X-Content-Type-Options: nosniff");