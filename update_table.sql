ALTER TABLE  `promo` DROP  `id_fasilitas` ;
ALTER TABLE  `promo` ADD  `transaksi_min` INT NOT NULL ,
ADD  `transaksi_max` INT NOT NULL ;
ALTER TABLE  `promo` CHANGE  `transaksi_min`  `transaksi_min` INT( 11 ) NULL ,
CHANGE  `transaksi_max`  `transaksi_max` INT( 11 ) NULL ;