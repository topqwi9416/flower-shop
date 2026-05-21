#!/bin/bash

# Настройки БД
DB_NAME="flower_shop"
DB_USER="flower_user"
DB_HOST="127.0.0.1"
DB_PORT="5432"

# Папка для бэкапов
BACKUP_DIR="$(dirname "$0")/backups"
mkdir -p "$BACKUP_DIR"

# Имя файла с датой
DATE=$(date +"%Y%m%d_%H%M%S")
BACKUP_FILE="$BACKUP_DIR/${DB_NAME}_backup_${DATE}.sql"

echo "Создание резервной копии БД: $DB_NAME"
echo "Файл: $BACKUP_FILE"

# Создаём бэкап
PGPASSWORD="12345" pg_dump \
    -h $DB_HOST \
    -p $DB_PORT \
    -U $DB_USER \
    -F p \
    --no-owner \
    --no-acl \
    $DB_NAME > "$BACKUP_FILE"

if [ $? -eq 0 ]; then
    echo "✅ Бэкап успешно создан: $BACKUP_FILE"
    echo "Размер файла: $(du -sh $BACKUP_FILE | cut -f1)"
else
    echo "❌ Ошибка при создании бэкапа!"
    exit 1
fi
