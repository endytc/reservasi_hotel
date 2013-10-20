ALTER TABLE  `fasilitas_pengunjung` ADD FOREIGN KEY (  `id_checkin` ) REFERENCES  `db_reservasi_hotel`.`checkin` (
`id`
);

