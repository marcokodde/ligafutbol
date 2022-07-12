SELECT us.name,us.email,cat.name,te.name,te.zipcode,zc.town,zc.state
FROM teams te,categories cat,users us,zipcodes zc
WHERE cat.id = te.category_id
  AND us.id = te.user_id
  AND zc.zipcode = te.zipcode
ORDER BY us.name,cat.name

/* Equipos cuyo usuario no ha aceptado deslinde de responsabilidades */
SELECT us.name,us.email,cat.name,te.name,te.zipcode,zc.town,zc.state
FROM teams te,categories cat,users us,zipcodes zc
WHERE cat.id = te.category_id
  AND us.id = te.user_id
  AND zc.zipcode = te.zipcode
  AND us.accept_responsibilities IS NULL
ORDER BY us.name,cat.name

//
SELECT us.name, us.phone, cat.name,te.name,zip.town,zip.state,pay.amount/pay.source as Pagado
FROM users us
LEFT JOIN teams as 	te ON us.id = te.user_id
LEFT JOIN categories  	cat ON cat.id = te.category_id
LEFT JOIN zipcodes  	zip ON zip.zipcode = te.zipcode
LEFT JOIN payments 		pay ON pay.id = te.payment_id
WHERE us.id NOT IN (1,2,3)
ORDER BY us.name,cat.name,te.name
