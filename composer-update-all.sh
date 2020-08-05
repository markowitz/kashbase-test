#!/usr/bin/env bash
ROOTDIR=${PWD}

cd api
echo "Running composer on the API router."
composer update
echo "Completed"

cd ${ROOTDIR}
cd microservices

# Loop through all directories
for d in * ; do
    # Check if its a directory
    if [ -d ${f} ]; then
        COMPOSER_FILE="${d}/composer.json"
        if [[ -f "${COMPOSER_FILE}" ]]; then
            cd "${d}"
            echo "Running composer on the API router."
            composer update
            echo "Completed"
            cd ../
        fi
    fi
done
