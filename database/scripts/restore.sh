#!/bin/bash

# Настройки БД
DB_NAME="flower_shop"
DB_USER="flower_user"
DB_HOST="127.0.0.1"
DB_PORT="5432"

# Проверяем аргумент
if [ -z "$1" ]; then
    echo "Использование: ./restore.sh <путь_к_файлу_бэкапа>"
    echo "Пример: ./restore.sh backups/flower_shop_backup_20250503.sql"
    exit 1
fi

BACKUP_FILE="$1"

if [ ! -f "$BACKUP_FILE" ]; then
    echo "❌ Файл не найден: $BACKUP_FILE"
    exit 1
fi

echo "⚠️  Восстановление БД из: $BACKUP_FILE"
echo "БД $DB_NAME будет очищена и восстановлена!"
read -p "Продолжить? (y/n): " confirm

if [ "$confirm" != "y" ]; then
    echo "Отменено."
    exit 0
fi

# Удаляем и пересоздаём БД
echo "Пересоздание БД..."
PGPASSWORD="12345" psql -h $DB_HOST -p $DB_PORT -U $DB_USER -d postgres << SQLEOF
DROP DATABASE IF EXISTS $DB_NAME;
CREATE DATABASE $DB_NAME OWNER $DB_USER;
SQLEOF

# Восстанавливаем из бэкапа
echo "Восстановление данных..."
PGPASSWORD="12345" psql \
    -h $DB_HOST \
    -p $DB_PORT \
    -U $DB_USER \
    -d $DB_NAME \
    -f "$BACKUP_FILE"

if [ $? -eq 0 ]; then
    echo "✅ БД успешно восстановлена!"
else
    echo "❌ Ошибка при восстановлении!"
    exit 1
fi
