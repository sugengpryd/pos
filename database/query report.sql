SELECT 
    t.id AS transaksi_id,
    t.batch_id,
    t.customer_id,
    t.menu_id,
    t.qty,
    t.sellingPrice,
    t.total AS subtotal_transaksi,
    p.discount,
    p.pph,
    p.grandtotal,
    p.tipe_payment,
    pr.fromName,
    pr.toName,
    pr.BiayaKirim
FROM transaksi t
JOIN payment p ON t.batch_id = p.batch_id
JOIN pengiriman pr ON t.batch_id = pr.batch_id;

SELECT 
    t.batch_id,
    GROUP_CONCAT(t.menu_id || ' (x' || t.qty || ')') AS purchased_menus,
    p.grandtotal,
    p.tipe_payment,
    pr.toName,
    pr.BiayaKirim
FROM transaksi t
JOIN payment p ON t.batch_id = p.batch_id
JOIN pengiriman pr ON t.batch_id = pr.batch_id
GROUP BY t.batch_id, p.grandtotal, p.tipe_payment, pr.toName, pr.BiayaKirim;

SELECT batch_id, COUNT(*) as total_items
FROM transaksi
GROUP BY batch_id;

SELECT 
    t.batch_id,
    t.id AS transaksi_id,
    t.menu_id,
    t.qty,
    t.sellingPrice,
    t.total AS item_total,
    p.grandtotal,
    p.tipe_payment,
    pr.toName,
    pr.BiayaKirim
FROM transaksi t
JOIN payment p ON t.batch_id = p.batch_id
JOIN pengiriman pr ON t.batch_id = pr.batch_id
ORDER BY t.batch_id ASC;

SELECT 
    t.batch_id,
    t.id AS transaksi_id,
    t.menu_id,
    t.qty,
    t.sellingPrice,
    t.total AS item_total,
    p.grandtotal,
    p.tipe_payment,
    pr.toName,
    pr.BiayaKirim
FROM transaksi t
JOIN payment p ON t.batch_id = p.batch_id
JOIN pengiriman pr ON t.batch_id = pr.batch_id
WHERE t.batch_id = '1'; -- Ganti dengan ID batch yang ingin dilihat

SELECT 
    t.batch_id,
    COUNT(t.id) AS total_items_bought,
    SUM(t.total) AS sum_item_totals,
    p.grandtotal,
    p.tipe_payment,
    pr.toName,
    pr.BiayaKirim
FROM transaksi t
JOIN payment p ON t.batch_id = p.batch_id
JOIN pengiriman pr ON t.batch_id = pr.batch_id
GROUP BY t.batch_id, p.grandtotal, p.tipe_payment, pr.toName, pr.BiayaKirim;

SELECT 
    t.batch_id,
	c.nama as 'customer' ,
    p.grandtotal,
    p.tipe_payment,
	p.total,
    pr.toName,
    pr.BiayaKirim,
    d.discount
FROM transaksi t
LEFT JOIN customer c ON t.customer_id = c.id
LEFT JOIN payment p ON t.batch_id = p.batch_id
LEFT JOIN pengiriman pr ON t.batch_id = pr.batch_Id
LEFT JOIN discount d ON t.batch_id = d.batch_id
GROUP BY t.batch_id;