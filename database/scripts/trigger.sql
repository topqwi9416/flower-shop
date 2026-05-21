-- Функция триггера — пересчёт суммы заказа
CREATE OR REPLACE FUNCTION calc_order_total()
RETURNS TRIGGER
LANGUAGE plpgsql
AS $$
BEGIN
    -- Пересчитываем total_amount в таблице orders
    UPDATE orders
    SET total_amount = (
        SELECT COALESCE(SUM(quantity * price), 0)
        FROM order_items
        WHERE order_id = COALESCE(NEW.order_id, OLD.order_id)
    )
    WHERE id = COALESCE(NEW.order_id, OLD.order_id);

    RETURN NEW;
END;
$$;

-- Триггер срабатывает после INSERT или UPDATE в order_items
DROP TRIGGER IF EXISTS trg_calc_order_total ON order_items;

CREATE TRIGGER trg_calc_order_total
AFTER INSERT OR UPDATE OR DELETE ON order_items
FOR EACH ROW
EXECUTE FUNCTION calc_order_total();

-- Пояснение:
-- Триггер относится к предметной области (бизнес-правило):
-- сумма заказа = сумма всех позиций, это не техническая деталь,
-- а правило расчёта стоимости заказа в цветочном магазине.
--
-- В MySQL реализация отличается:
-- DELIMITER $$
-- CREATE TRIGGER trg_calc_order_total
-- AFTER INSERT ON order_items
-- FOR EACH ROW
-- BEGIN
--     UPDATE orders SET total_amount = (
--         SELECT COALESCE(SUM(quantity * price), 0)
--         FROM order_items WHERE order_id = NEW.order_id
--     ) WHERE id = NEW.order_id;
-- END$$
-- DELIMITER ;
