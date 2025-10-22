#!/bin/bash
cd /home/admin/web/aviator.xhost.co.in/public_html/ && php82 artisan schedule:run >> /dev/null 2>&1
