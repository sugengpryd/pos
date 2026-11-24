select sum(total) from transaksi

select sum(total) from payment

select transaksi.batch_id, transaksi.total as ttotal, payment.discount as pdiskon, payment.total as ptotal from transaksi, payment  where (transaksi.batch_id = payment.batch_id)