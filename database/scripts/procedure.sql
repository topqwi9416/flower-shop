-- Процедура для получения сводки заказов за период
CREATE OR REPLACE FUNCTION GetOrderSummaryByPeriod(
    start_date DATE,
    end_date   DATE
)
RETURNS TABLE (
    customer_name    VARCHAR,
    orders_count     BIGINT,
    total_items      BIGINT,
    total_sum        NUMERIC
)
LANGUAGE plpgsql
AS $$
BEGIN
    RETURN QUERY
    SELECT
        o.customer_name,
        COUNT(DISTINCT o.id)        AS orders_count,
        SUM(oi.quantity)            AS total_items,
        SUM(o.total_amount)         AS total_sum
    FROM orders o
    LEFT JOIN order_items oi ON oi.order_id = o.id
    WHERE o.created_at::DATE BETWEEN start_date AND end_date
    GROUP BY o.customer_name
    ORDER BY total_sum DESC;
END;
$$;

-- Пример вызова:
-- SELECT * FROM GetOrderSummaryByPeriod('2025-01-01', '2025-12-31');
