#!/bin/sh

chmod 777 -R /app/public/uploads
#chmod 777 -R /app/src/Domain/Pdf/files

exec "$@"
