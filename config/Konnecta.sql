create database cafeteria;

use cafeteria;

CREATE TABLE producto(
id BIGINT AUTO_INCREMENT PRIMARY KEY,
nombre varchar(50) not null,
referencia varchar(50) not null,
precio int(11) not null,
peso int(11) not null,
categoria varchar(50) not null,
stock int(11) not null,
fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE producto_venta(
id INT(11) NOT NULL AUTO_INCREMENT,
idProducto BIGINT NOT NULL,
cantidad int(11) NOT NULL,
CONSTRAINT producto_venta_primaryPK PRIMARY KEY (id),
FOREIGN KEY(idProducto) REFERENCES producto(id) ON DELETE CASCADE
);

/*Consultas */
select producto_venta.idProducto,producto.nombre ,  SUM(producto_venta.cantidad) as "Cantidad"
from producto_venta 
inner join producto ON producto_venta.idProducto = producto.id
GROUP BY producto_venta.idProducto 
LIMIT 0 , 1;

SELECT id,nombre,
SUM(stock) as "Total"
FROM producto
GROUP BY producto.stock
order by producto.stock desc
LIMIT 0 , 1;
