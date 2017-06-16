#!/bin/bash

echo "Changing permissions on files."

find ./ -type d -exec chmod 755 {} \;
find ./ -type f -exec chmod 644 {} \;
